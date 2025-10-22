<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
class UserController extends Controller
{
    public function Dashboard()
    {
        if(Auth::check() && Auth::user()->user_type == 'user'){
            return view('dashboard');
        }
        else if(Auth::check() && Auth::user()->user_type == 'admin'){
            return view('admin.dashboard');
        }
        else{
            return redirect()->route('login');
        }
       
    }
    public function Index()
    {
        $doctors = Doctor::all();
        return view('index', compact('doctors'));
    }
    public function allDoctors()
    {
        $doctors = Doctor::all();
        return view('doctors', compact('doctors'));
    }
}
