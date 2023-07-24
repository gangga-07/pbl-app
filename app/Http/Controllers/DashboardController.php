<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $request->session()->flush();
        return view('dashboard.admin.dashboard');
    }
}
