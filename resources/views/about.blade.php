@extends('main')
@section('about_page')

<div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('fronend/assets/img/bg_image_1.jpg') }});">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <nav aria-label="Breadcrumb">
        <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
          <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
      </nav>
      <h1 class="font-weight-normal">About Us</h1>
    </div>
  </div>
</div>


<div class="page-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 wow fadeInUp">
        <h1 class="text-center mb-3">Welcome to Deep Shikha</h1>
        <div class="text-lg">
          <p>Deep Shikha is a premier healthcare facility dedicated to providing comprehensive medical services to our patients. Our team of experienced doctors and healthcare professionals are committed to delivering personalized care and treatment to ensure the best possible outcomes for our patients.</p>
          <p>We understand that every patient is unique, and we take the time to listen to your concerns and tailor our services to meet your individual needs. Whether you require routine check-ups, specialized treatments, or emergency care, we are here to support you on your health journey.</p>
          <p>It is our mission to provide high-quality healthcare services that are accessible and affordable to everyone. We believe that everyone deserves to receive the best possible care, and we are committed to making that a reality.</p>
          <p>At Deep Shikha, we prioritize patient satisfaction and strive to create a welcoming and compassionate environment for all. Your health and well-being are our top priorities, and we are here to serve you.</p>
        </div>
      </div>
      <div class="col-lg-10 mt-5">
        <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>
        <div class="row justify-content-center">
          @foreach($doctors->take(3) as $doctor)
          <div class="col-md-6 col-lg-4 wow zoomIn">
            <div class="card-doctor">
              <div class="header">
                <img src="{{ asset('doctorimg/'.$doctor->doctor_image) }}" alt="{{ $doctor->doctors_name }}">
                <div class="meta">
                  <a href="tel:{{ $doctor->doctors_phone }}"><span class="mai-call"></span></a>
                  <a href="https://wa.me/{{ $doctor->doctors_phone }}"><span class="mai-logo-whatsapp"></span></a>
                </div>
              </div>
              <div class="body">
                <p class="text-xl mb-0">{{ $doctor->doctors_name }}</p>
                <span class="text-sm text-grey">{{ $doctor->speciality }}</span>
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
