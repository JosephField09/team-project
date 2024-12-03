<?php

namespace App\Http\Controllers;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
