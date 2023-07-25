<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Mail\WelcomeTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);

        return view('admins.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        // dd($request->all());
        // validation

        // upload file
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);

        // store data
        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'image' => $img_name,
            'ex_years' => $request->ex_years,
            'bio' => $request->bio,
        ]);

        $info = $request->only('name', 'email', 'password');

        // Send Welcome Mail with credential data
        Mail::to($request->email)->send(new WelcomeTeacher($info));

        // redirect
        return redirect()->route('admin.teachers.index')
        ->with('msg', 'Teacher added successfully')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);

        return view('admins.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        // dd($request->all());
        $teacher = Teacher::find($id);

        $img_name = $teacher->image;
        if($request->hasFile('image')) {
            // upload file
            File::delete(public_path('images/'.$teacher->image));
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);
        }

        // store data
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $img_name,
            'ex_years' => $request->ex_years,
            'bio' => $request->bio,
        ]);

        // redirect
        return redirect()->route('admin.teachers.index')
        ->with('msg', 'Teacher updated successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        File::delete(public_path('images/'.$teacher->image));

        $teacher->delete();

        return redirect()->route('admin.teachers.index')
        ->with('msg', 'Teacher deleted successfully')
        ->with('type', 'info');
    }
}
