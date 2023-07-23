<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index() {
        return view('students.home');
    }

    function courses() {
        return view('students.courses');
    }

    function appointment() {
        return view('students.appointment');
    }
}
