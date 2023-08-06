<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
