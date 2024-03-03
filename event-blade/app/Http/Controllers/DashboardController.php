<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        if (Auth::id()){
            $usertype = Auth::user()->usertype;

            if($usertype=='admin'){
                return view('dashboardadmin');
            }
            else{
                return view('dashboard');
            }
        }
    }
}
