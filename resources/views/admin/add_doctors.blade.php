@extends('admin.main')
@section('add_doctors')

  <form action="{{route('post_add_doctor')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(session('doctor_addmessage'))
    <div class="bg bg-primary">
        {{session('doctor_addmessage')}}
    </div>
    @endif
    <div>
        <label for="doctors_name">Doctor Name:</label>
        <input type="text" id="doctors_name" name="doctors_name" required placeholder="Enter Doctor Name">
    </div><br>

    <div>
        <label for="doctors_phone">Contact Information:</label>
        <input type="text" id="doctors_phone" name="doctors_phone" required placeholder="Enter Contact Information">
    </div><br>

    <div>
        <label for="speciality">Specialization:</label>
        <input type="text" id="speciality" name="speciality" required placeholder="Enter Specialization">
    </div><br>
    <div>
        <label for="room_number">Room Number:</label>
        <input type="text" id="room_number" name="room_number" required placeholder="Enter Room Number">
    </div><br>
    <div>
        <label style="border-radius: 10px; padding: 8px;" class="bg bg-primary" for="doctor_image">Doctor Image:</label><br><br>
        <input type="file" id="doctor_image" name="doctor_image" required>
    </div><br>

    <div>
        <input type="submit" class="btn btn-success" name="submit" value="Add Doctor">
    </div>
  </form>

@endsection