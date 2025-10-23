<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Deep-Shikha - Medical Center</title>

 <link rel="stylesheet" href="{{ asset('fronend/assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('fronend/assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('fronend/assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('fronend/assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('fronend/assets/css/theme.css') }}">
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">Deep</span>-Shikha</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('about') }}">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('alldoctors') }}">Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('news') }}">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            @if(!Auth::check())
            <li>
                <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Login</a>
            </li>
            @else
            <li class="nav-item">
                 <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
              
            </li>
             <li>
                <a class="btn btn-primary ml-lg-3" href="{{ route('dashboard') }}">Dashboard</a>
            </li>

            @endif
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
 <!-- .bg-light -->

<!-- doctors section -->
 @yield('index_page')
 @yield('all_doctors')
 @yield('news_page')
 @yield('about_page')

  <div class="page-section bg-light">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Latest News</h1>
      <div class="row mt-5">
        @forelse($news ?? [] as $article)
          <div class="col-lg-4 py-2 wow zoomIn">
            <div class="card-blog">
              <div class="header">
                <div class="post-category">
                  <a href="#">{{ $article['source']['name'] ?? 'Health' }}</a>
                </div>
                <a href="{{ $article['url'] ?? '#' }}" target="_blank" class="post-thumb">
                  <img src="{{ $article['urlToImage'] ?? asset('fronend/assets/img/blog/blog_1.jpg') }}" 
                       alt="{{ $article['title'] ?? 'News' }}"
                       onerror="this.src='{{ asset('fronend/assets/img/blog/blog_1.jpg') }}'">
                </a>
              </div>
              <div class="body">
                <h5 class="post-title">
                  <a href="{{ $article['url'] ?? '#' }}" target="_blank">
                    {{ Str::limit($article['title'] ?? 'Health News', 60) }}
                  </a>
                </h5>
                <div class="site-info">
                  <div class="avatar mr-2">
                    <div class="avatar-img">
                      <img src="{{ asset('fronend/assets/img/person/person_1.jpg') }}" alt="">
                    </div>
                    <span>{{ Str::limit($article['author'] ?? 'Health News', 20) }}</span>
                  </div>
                  <span class="mai-time"></span> 
                  {{ \Carbon\Carbon::parse($article['publishedAt'] ?? now())->diffForHumans() }}
                </div>
              </div>
            </div>
          </div>
        @empty
          
        @endforelse

        <div class="col-12 text-center mt-4 wow zoomIn">
          <a href="{{ route('news') }}" target="_blank" class="btn btn-primary">Read More</a>
        </div>

      </div>
    </div>
  </div> <!-- .page-section -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>
      <p class="bg bg-primary">
        @if(session('appointment_message'))

            {{ session('appointment_message') }}

        @endif
      </p>

      <form class="main-form" action="{{ route('appointment') }}" method="post">
        @csrf
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text"name="full_name" class="form-control" placeholder="Full name">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" name="email_address" class="form-control" placeholder="Email address..">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" name="submission_date" class="form-control">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="speciality" id="departement" class="custom-select"> 
              @foreach($doctors as $doctor)            
              <option value="{{$doctor->speciality}}">Doctor {{$doctor->doctors_name}}--{{$doctor->speciality}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" name="number" class="form-control" placeholder="Number..">
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
      </form>
    </div>
  </div> <!-- .page-section -->

  

  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Editorial Team</a></li>
            <li><a href="#">Protection</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>More</h5>
          <ul class="footer-menu">
            <li><a href="#">Terms & Condition</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Advertise</a></li>
            <li><a href="#">Join as Doctors</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Our partner</h5>
          <ul class="footer-menu">
            <li><a href="#">One-Fitness</a></li>
            <li><a href="#">One-Drugs</a></li>
            <li><a href="#">One-Live</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contact</h5>
          <p class="footer-link mt-2">351 Willow Street Franklin, MA 02038</p>
          <a href="#" class="footer-link">701-573-7582</a>
          <a href="#" class="footer-link">healthcare@temporary.net</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>

      <hr>

      <p id="copyright">Copyright &copy; 2025 <a href="https://macodeid.com/" target="_blank">MACode ID</a>. All right reserved</p>
    </div>
  </footer>

<script src="{{ asset('fronend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('fronend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('fronend/assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('fronend/assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('fronend/assets/js/theme.js') }}"></script>

</body>
</html>