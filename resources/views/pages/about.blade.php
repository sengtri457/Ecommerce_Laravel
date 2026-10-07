@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => $page->title,
        'subtitle' => $page->subtitle,
        'image' => $page->banner_image ?: 'assets/images/about-header-bg.jpg',
        'breadcrumbs' => [
            ['label' => 'About Us', 'url' => route('pages.about')]
        ]
    ])

    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center mb-5">
                    <h2 class="title">{{ $page->title }}</h2>
                    <div class="lead-content text-muted">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

            <!-- Features / Values -->
            @if($features->count() > 0)
                <div class="row mb-5">
                    @foreach($features as $feat)
                        <div class="col-lg-4 col-sm-6 mb-3">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="{{ $feat->icon }}"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">{{ $feat->title }}</h3>
                                    <p>{{ $feat->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <hr class="mb-5">

            <!-- Team Members -->
            @if($team->count() > 0)
                <h2 class="title text-center mb-4">Meet Our Team</h2>
                <div class="row mb-5 justify-content-center">
                    @foreach($team as $member)
                        <div class="col-md-4 mb-3">
                            <div class="member member-anim text-center">
                                <figure class="member-media">
                                    <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}">
                                </figure>
                                <div class="member-content">
                                    <h3 class="member-title">{{ $member->name }}<span>{{ $member->role }}</span></h3>
                                    @if($member->bio)
                                        <p class="text-muted">{{ $member->bio }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Testimonials -->
            @if($testimonials->count() > 0)
                <div class="testimonials bg-light py-5 rounded">
                    <h2 class="title text-center mb-4">What Our Clients Say</h2>
                    <div class="row justify-content-center">
                        @foreach($testimonials as $test)
                            <div class="col-md-5 mb-3 text-center px-4">
                                <blockquote class="testimonial">
                                    <p>“ {{ $test->quote }} ”</p>
                                    <cite>
                                        {{ $test->author_name }}
                                        @if($test->author_role)<span>{{ $test->author_role }}</span>@endif
                                    </cite>
                                </blockquote>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
