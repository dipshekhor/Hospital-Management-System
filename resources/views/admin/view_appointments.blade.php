@extends('admin.main')


@section('view_appointments')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">View Appointments</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Submission Date</th>
                                        <th>Speciality</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->full_name }}</td>
                                            <td>{{ $appointment->email_address}}</td>
                                            <td>{{ $appointment->submission_date }}</td>
                                            <td>{{ $appointment->speciality }}</td>
                                            <td>{{ $appointment->number }}</td>
                                            <td>{{ $appointment->message }}</td>
                                            <td>{{ $appointment->status }}</td>
                                            <td>
                                               <form action="{{ route('changestatus', $appointment->id) }}" method="POST">
                                                 @csrf
                                                  <select name="status" id="status">

                                                    <option value="Approved">Approved</option>
                                                    <option value="Canceled">Canceled</option>
                                                    <option value="In Progress">In Progress</option>
                                                  </select>
                                                  <input type="submit" class="btn btn-primary btn-sm" value="Change Status">
                                               </form>
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