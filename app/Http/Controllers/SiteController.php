<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    function index() {

        // Eloquent
        $s_count = User::count();
        $c_count = Course::count();
        $t_count = Teacher::count();

        // Query Builder
        // $teacher = DB::table('teachers')->count();



        $courses = Course::latest('id')->limit(6)->get();


        return view('front.index', compact('courses', 's_count', 'c_count', 't_count'));
    }

    function course($id) {
        $course = Course::find($id);

        return view('front.course', compact('course'));
    }

    function teacher($id) {
        $teacher = Teacher::find($id);

        $events = $teacher->available_times->map(function($data) {
            return [
                'title' => $data->time_from . ' - ' . $data->time_to,
                'start' => $data->day,
                'url' => url('/')
            ];
        });

        $events = json_encode($events);

        // dd($event);

        return view('front.teacher', compact('teacher', 'events'));
    }

    function search(Request $request) {

        $courses = Course::where('name_en', 'like', '%'.$request->q.'%')
        ->orWhere('name_ar', 'like', '%'.$request->q.'%')
        ->orWhere('content_en', 'like', '%'.$request->q.'%')
        ->orWhere('content_ar', 'like', '%'.$request->q.'%')
        ->orWhereHas('teacher', function($query) use ($request) {
            // global $request;
            $query->where('name','like', '%'.$request->q.'%');
        })
        ->get();

        dd($courses);

        return view('front.search');
    }

    function enroll($id) {
        $course = Course::find($id);

        // prepare the checkout
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" . $course->price .
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);

        $id = $responseData['id']??'';

        return view('front.enroll', compact('course', 'id'));
    }

    function payment(Request $request, $id) {

        $course = Course::find($id);

        $resourcePath = $request->resourcePath;

        $url = "https://eu-test.oppwa.com/$resourcePath";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData = json_decode($responseData, true);


        $code = $responseData['result']['code'];

        if($code == '000.100.110') {

            $id = $responseData['id'];
            $amount = $responseData['amount'];

            $teacher_revenue = $amount * .4;
            $amount = $amount - $teacher_revenue;

            // add new payment record
            Payment::create([
                'user_id' => Auth::guard('web')->id(),
                'amount' => $amount,
                'teacher_revenue' => $teacher_revenue,
                'service_name' => $course->name,
                'service_id' => $course->id,
                'transaction_id' => $id
            ]);

            // add teacher revenue to his account
            $course->teacher()->increment('revenue', $teacher_revenue);

            // register user in teacher course
            $course->students()->attach([Auth::id()]);

            return view('front.payment_success')->with('msg', 'Payment Done Successfully');

        }else {
            return redirect()->back()->with('failed', 'Payment Process Decline');
        }
    }
}
