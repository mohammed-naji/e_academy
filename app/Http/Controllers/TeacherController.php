<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    function index() {
        return view('teachers.home');
    }

    function courses() {
        return view('teachers.courses');
    }

    function appointment() {
        return view('teachers.appointment');
    }
}
