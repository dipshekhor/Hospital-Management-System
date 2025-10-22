<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
class AdminController extends Controller
{
    //
    public function addDoctors()
    {
        return view('admin.add_doctors');
    }
    public function postAddDoctor(Request $request)
    {
        $doctor = new Doctor();
        $doctor->doctors_name = $request->doctors_name;
        $doctor->doctors_phone = $request->doctors_phone;
        $doctor->speciality = $request->speciality;
        $doctor->room_number = $request->room_number;
        $image = $request->doctor_image;
        if($image){
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $doctor->doctor_image = $image_name;
        }
        $doctor->save();
        if($image && $doctor->save()){
            $request->doctor_image->move('doctorimg', $image_name);
        }
        return redirect()->back()->with('doctor_addmessage', 'Doctor added successfully !');
        
    }
}
