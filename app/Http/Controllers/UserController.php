<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Services\NewsService;

class UserController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
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
        try {
            $doctors = Doctor::all();
            $news = $this->newsService->getHealthNews(3);
        } catch (\Exception $e) {
            // If there's an error, use empty arrays
            $doctors = Doctor::all();
            $news = [];
        }
        return view('index', compact('doctors', 'news'));
    }
    public function allDoctors()
    {
        $doctors = Doctor::all();
        return view('doctors', compact('doctors'));
    }
    public function MakeAnAppointment(Request $request)
    {
       $appointment = new Appointment();
       $appointment->full_name = $request->full_name;
       $appointment->email_address = $request->email_address;
       $appointment->submission_date = $request->submission_date;
       $appointment->speciality = $request->speciality;
       $appointment->doctor_name = $request->doctor_name;
       $appointment->number = $request->number;
       $appointment->message = $request->message;


       $appointment->save();
       return redirect()->back()->with('appointment_message', 'Your appointment request has been submitted successfully !');
    }

    public function News()
    {
        $doctors = Doctor::all(); // Add doctors variable for main layout
        $news = $this->newsService->getHealthNews(12); // Get 12 news articles for the news page
        return view('news', compact('news', 'doctors'));
    }

    public function About()
    {
        $doctors = Doctor::all();
        return view('about', compact('doctors'));
    }

    public function doctorDetails($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctors = Doctor::all(); // For navbar/layout
        return view('doctor-details', compact('doctor', 'doctors'));
    }
}
