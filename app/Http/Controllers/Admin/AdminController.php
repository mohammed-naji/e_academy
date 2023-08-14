<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function index() {

        $paymentData = Payment::selectRaw("YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_amount")
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // dd($paymentData);

        return view('admins.home', compact('paymentData'));
    }
}
