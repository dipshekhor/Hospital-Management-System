@extends('admin.main')
@section('view_doctors')
    <h1>View Doctors</h1>
    <table class="table">
        <thead>
            <tr style="background-color: lightgray;">
                <th>Name</th>
                <th>Phone</th>
                <th>Speciality</th>
                <th>Room Number</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->doctors_name }}</td>
                    <td>{{ $doctor->doctors_phone }}</td>
                    <td>{{ $doctor->speciality }}</td>
                    <td>{{ $doctor->room_number }}</td>
                    <td><img src="{{ asset('doctorimg/'.$doctor->doctor_image) }}" alt="{{ $doctor->doctor_image }}" width="100" height="100"></td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('delete_doctor', $doctor->id) }}" onclick="return confirm('Are you sure you want to delete this doctor?');" style="cursor: pointer; text-decoration: none; padding: 10px;color:black">Delete</a>
                    </td> 
                </tr>

            @endforeach
        </tbody>
    </table>
@endsection