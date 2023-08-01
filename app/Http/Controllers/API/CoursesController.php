<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(request()->has('token') && request()->token == 123) {
        //     return [
        //         'status' => true,
        //         'message' => 'All Courses',
        //         'data' => Course::all()
        //     ];
        // }else {
        //     return [
        //         'status' => true,
        //         'message' => 'Not Authorized',
        //         'data' => []
        //     ];
        // }

        return [
            'status' => true,
            'message' => 'All Courses',
            'data' => Course::all()
        ];

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

        $course = Course::create($data);

        return response()->json([
            'status' => true,
            'message' => 'All Courses',
            'data' => $course
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
