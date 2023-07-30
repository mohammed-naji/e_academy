<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    function index() {
        return view('teachers.home');
    }

    function courses() {
        $teacher = Auth::user();

        $courses = $teacher->courses()->paginate(20);

        return view('teachers.courses',compact('courses'));
    }

    function appointment() {
        $teacher = Auth::user();

        $appointments = $teacher->appointments()->paginate(20);
        return view('teachers.appointment', compact('appointments'));
    }

    function course_students($id) {
        $courses = Course::find($id);

        return $courses->students;
    }

    function profile() {
        return view('teachers.profile');
    }

    function profile_update(Request $request) {


        // upload file
        $img_name = Auth::user()->image;

        if($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);
        }

        Auth::user()->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'ex_years' => $request->ex_years,
            'image' => $img_name,
            'bio' => $request->bio,
        ]);

        return redirect()->back();

    }

    function appointment_status($ap_id, $status) {
        Appointment::find($ap_id)->update([
            'status' => $status
        ]);

        return redirect()->back();
    }

    function profile_password() {
        return view('teachers.profile_password');
    }

    function profile_password_update(Request $request) {
        // $request->validate([
        //     'old_password' => 'required',
        //     'password' => 'required|confirmed'
        // ]);
        $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|confirmed|min:6'
            ]);

            if(!Hash::check($request->old_password, Auth::user()->password)) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'old_password', 'Old Password doesn\'t match'
                    );
                });
            }


            if($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

        if(Hash::check($request->old_password, Auth::user()->password)) {

            if(!Hash::check($request->password, Auth::user()->password)) {

                $teacher = Auth::user();

                $teacher->update([
                    'password' => bcrypt($request->password)
                ]);

                Auth::logout();

                return redirect('teacher/login');

            }else {

                return redirect()->back();
            }

        }else {

            // $validator->after(function ($validator) {
            //     $validator->errors()->add(
            //         'old_password', 'Old Password doesn\'t match'
            //     );
            // });

            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
}
