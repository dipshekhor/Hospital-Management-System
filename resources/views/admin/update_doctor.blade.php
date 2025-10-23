@extends('admin.main')
<base href="/public">
@section('view_doctors')
 <form action="{{route('post_update_doctor', $doctor->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(session('doctor_updatemessage'))
    <div class="bg bg-primary">
        {{session('doctor_updatemessage')}}
    </div>
    @endif
    <div>
        <label for="doctors_name">Doctor Name:</label>
        <input type="text" id="doctors_name" name="doctors_name" value="{{ $doctor->doctors_name }}">
    </div><br>

    <div>
        <label for="doctors_phone">Contact Information:</label>
        <input type="text" id="doctors_phone" name="doctors_phone" value="{{ $doctor->doctors_phone }}">
    </div><br>

    <div>
        <label for="speciality">Specialization:</label>
        <input type="text" id="speciality" name="speciality" value="{{ $doctor->speciality }}">
    </div><br>
    <div>
        <label for="room_number">Room Number:</label>
        <input type="text" id="room_number" name="room_number" value="{{ $doctor->room_number }}">
    </div><br>
    <div>
        <label style="border-radius: 10px; padding: 8px;" class="bg bg-primary"
         for="doctor_image">Old Image:</label><br><br>
        <img src="{{ asset('doctorimg/'.$doctor->doctor_image) }}" 
        alt="{{ $doctor->doctor_image }}" style="width: 200px; height: 200px;">
    </div><br>
    <div>
        <label style="border-radius: 10px; padding: 8px;" class="bg bg-primary" for="doctor_image"> Upload New Image:</label><br><br>
        <input type="file" id="doctor_image" name="doctor_image">
    </div><br>

    <div>
        <input type="submit" class="btn btn-success" name="submit" value="Update Doctor">
    </div>
  </form>
@endsection