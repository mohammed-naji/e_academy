<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->paginate(10);

        return view('admins.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::select('id', 'name')->get();
        $course = new Course();

        return view('admins.courses.create', compact('course','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
            'teacher_id' => 'required',
        ]);

        // upload file
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);

        $data = $request->except('_token', 'image');
        $data['image'] = $img_name;

        // dd($data);

        Course::create($data);

        return redirect()->route('admin.courses.index')
        ->with('msg', 'Course added successfully')
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
    public function edit(Course $course)
    {
        $teachers = Teacher::select('id', 'name')->get();

        return view('admins.courses.edit', compact('course', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'nullable',
            'price' => 'required',
            'duration' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
            'teacher_id' => 'required',
        ]);

        $data = $request->except('_token', 'image');

        if($request->hasFile('image')) {
            // upload file
            File::delete(public_path('images/'.$course->image));
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);
            $data['image'] = $img_name;
        }
        // dd($data);

        $course->update($data);

        return redirect()->route('admin.courses.index')
        ->with('msg', 'Course updated successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        File::delete(public_path('images/'.$course->image));

        $course->delete();

        return redirect()->route('admin.courses.index')
        ->with('msg', 'Course deleted successfully')
        ->with('type', 'info');
    }
}
