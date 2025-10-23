@extends('main')

@section('news_page')
<div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('fronend/assets/img/bg_image_1.jpg') }});">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Health News</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Latest Health News</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
</div> <!-- .page-banner -->

<div class="page-section">
    <div class="container">
        <div class="row justify-content-center">
            @forelse($news as $article)
                <div class="col-lg-4 col-md-6 py-3 wow zoomIn">
                    <div class="card-blog">
                        <div class="header">
                            <div class="post-category">
                                <a href="#">{{ $article['source']['name'] ?? 'Health News' }}</a>
                            </div>
                            <a href="{{ $article['url'] }}" target="_blank" class="post-thumb">
                                <img src="{{ $article['urlToImage'] ?? asset('fronend/assets/img/blog/blog_1.jpg') }}" 
                                     alt="{{ $article['title'] }}"
                                     onerror="this.src='{{ asset('fronend/assets/img/blog/blog_1.jpg') }}'">
                            </a>
                        </div>
                        <div class="body">
                            <h5 class="post-title">
                                <a href="{{ $article['url'] }}" target="_blank">
                                    {{ Str::limit($article['title'], 60) }}
                                </a>
                            </h5>
                            <p class="post-excerpt">
                                {{ Str::limit($article['description'] ?? 'Read more about this health news...', 100) }}
                            </p>
                            <div class="site-info">
                                <div class="avatar mr-2">
                                    <div class="avatar-img">
                                        <img src="{{ asset('fronend/assets/img/person/person_1.jpg') }}" alt="">
                                    </div>
                                    <span>{{ Str::limit($article['author'] ?? 'Health Desk', 20) }}</span>
                                </div>
                                <span class="mai-time"></span> 
                                {{ \Carbon\Carbon::parse($article['publishedAt'])->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <h4>No health news available at the moment.</h4>
                        <p>Please check back later for the latest health updates.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if(count($news) > 0)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="text-muted">
                        Showing {{ count($news) }} latest health news articles
                    </p>
                </div>
            </div>
        @endif
    </div> <!-- .container -->
</div> <!-- .page-section -->
@endsection
