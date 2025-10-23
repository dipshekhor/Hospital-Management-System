@extends('main')
@section('doctor_details')

<div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('fronend/assets/img/bg_image_1.jpg') }});">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <nav aria-label="Breadcrumb">
        <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
          <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('alldoctors') }}">Doctors</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $doctor->doctors_name }}</li>
        </ol>
      </nav>
      <h1 class="font-weight-normal">Doctor Details</h1>
    </div>
  </div>
</div>

<div class="page-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <img src="{{ asset('doctorimg/'.$doctor->doctor_image) }}" 
                 alt="{{ $doctor->doctors_name }}" 
                 class="img-fluid rounded-circle mb-3"
                 style="width: 250px; height: 250px; object-fit: cover;">
            <h3 class="mb-2">{{ $doctor->doctors_name }}</h3>
            <p class="text-muted mb-3">{{ $doctor->speciality }}</p>
            
            <div class="d-flex justify-content-center gap-2 mb-3">
              <a href="tel:{{ $doctor->doctors_phone }}" class="btn btn-primary btn-sm mx-1">
                <span class="mai-call"></span> Call
              </a>
              <a href="https://wa.me/{{ $doctor->doctors_phone }}" class="btn btn-success btn-sm mx-1" target="_blank">
                <span class="mai-logo-whatsapp"></span> WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Doctor Information</h4>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-4">
                <strong>Full Name:</strong>
              </div>
              <div class="col-md-8">
                {{ $doctor->doctors_name }}
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <strong>Speciality:</strong>
              </div>
              <div class="col-md-8">
                <span class="badge badge-primary">{{ $doctor->speciality }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <strong>Phone Number:</strong>
              </div>
              <div class="col-md-8">
                <a href="tel:{{ $doctor->doctors_phone }}">{{ $doctor->doctors_phone }}</a>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <strong>Room Number:</strong>
              </div>
              <div class="col-md-8">
                Room {{ $doctor->room_number }}
              </div>
            </div>

            <hr>

            <h5 class="mb-3">About the Doctor</h5>
            <p class="text-muted">
              {{ $doctor->doctors_name }} is a highly qualified {{ $doctor->speciality }} specialist with years of experience in providing exceptional healthcare services. The doctor is available for consultations in Room {{ $doctor->room_number }}.
            </p>

            <div class="mt-4">
              <h5 class="mb-3">Book an Appointment</h5>
              <p>To schedule an appointment with {{ $doctor->doctors_name }}, please contact:</p>
              <ul class="list-unstyled">
                <li><strong>Phone:</strong> <a href="tel:{{ $doctor->doctors_phone }}">{{ $doctor->doctors_phone }}</a></li>
                <li><strong>Room:</strong> {{ $doctor->room_number }}</li>
                <li><strong>Speciality:</strong> {{ $doctor->speciality }}</li>
              </ul>
              <a href="{{ route('index') }}#appointment" class="btn btn-primary mt-3">Make an Appointment</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12">
        <h3 class="mb-4">Other Doctors</h3>
        <div class="row">
          @foreach($doctors->where('id', '!=', $doctor->id)->take(3) as $otherDoctor)
          <div class="col-md-4 mb-3">
            <div class="card-doctor">
              <div class="header">
                <img src="{{ asset('doctorimg/'.$otherDoctor->doctor_image) }}" alt="{{ $otherDoctor->doctors_name }}">
                <div class="meta">
                  <a href="tel:{{ $otherDoctor->doctors_phone }}"><span class="mai-call"></span></a>
                  <a href="https://wa.me/{{ $otherDoctor->doctors_phone }}"><span class="mai-logo-whatsapp"></span></a>
                </div>
              </div>
              <div class="body">
                <p class="text-xl mb-0">{{ $otherDoctor->doctors_name }}</p>
                <span class="text-sm text-grey">{{ $otherDoctor->speciality }}</span>
                <br>
                <a href="{{ route('doctor.details', $otherDoctor->id) }}" class="btn btn-sm btn-primary mt-2">View Details</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
