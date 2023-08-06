<?php

namespace App\Http\Controllers;

use App\Models\AvailableTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Auth::user();
        $times = $teacher->available_times()->latest()->paginate(20);
        // $times = AvailableTime::paginate(20);

        return view('teachers.times.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.times.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'time_from' => 'required',
            'time_to' => 'required'
        ]);

        $data = $request->except('_token');
        $data['teacher_id'] = Auth::id();

        AvailableTime::create( $data );

        return redirect()->route('teacher.times.index');
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
    public function edit(string $id)
    {
        $time = AvailableTime::find($id);

        return view('teachers.times.edit', compact('time'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'day' => 'required',
            'time_from' => 'required',
            'time_to' => 'required'
        ]);

        $time = AvailableTime::find($id);

        $time->update($request->all());

        return redirect()->route('teacher.times.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AvailableTime::destroy($id);

        return redirect()->route('teacher.times.index');
    }
}
