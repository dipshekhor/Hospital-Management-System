@extends('admin.main')
@section('view_doctors')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">View Doctors</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
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
                                            <td>
                                                <img src="{{ asset('doctorimg/'.$doctor->doctor_image) }}" alt="{{ $doctor->doctor_image }}">
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm mr-2" href="{{ route('update_doctor', $doctor->id) }}">Update</a>
                                                <a class="btn btn-danger btn-sm" href="{{ route('delete_doctor', $doctor->id) }}" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection