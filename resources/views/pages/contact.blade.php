@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => $page->title ?? 'Contact Us',
        'subtitle' => $page->subtitle ?? 'We are available 24/7 to answer your questions',
        'image' => $page?->banner_image ?: 'assets/images/contact-header-bg.jpg',
        'breadcrumbs' => [
            ['label' => 'Contact Us', 'url' => route('contact.index')]
        ]
    ])

    <div class="page-content pb-0">
        <div class="container">
            <!-- Locations row -->
            @if(isset($locations) && $locations->count() > 0)
                <div class="row mb-5">
                    @foreach($locations as $loc)
                        <div class="col-md-6 mb-3">
                            <div class="contact-info bg-light p-4 rounded h-100">
                                <h3>{{ $loc->name }}</h3>
                                <p class="mb-1"><i class="icon-map-marker"></i> {{ $loc->address }}, {{ $loc->city }}</p>
                                <p class="mb-1"><i class="icon-phone"></i> {{ $loc->phone }}</p>
                                <p class="mb-1"><i class="icon-envelope"></i> {{ $loc->email }}</p>
                                @if($loc->opening_hours)
                                    <p class="mt-2 text-muted"><i class="icon-clock-o"></i> {!! nl2br(e($loc->opening_hours)) !!}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <hr class="mt-4 mb-5">

            <!-- Contact form row -->
            <div class="touch-container row justify-content-center mb-5">
                <div class="col-md-9 col-lg-7">
                    <div class="text-center">
                        <h2 class="title mb-1">Get In Touch</h2>
                        <p class="lead-text text-muted mb-4">Have questions regarding orders, technical specs, or wholesale requests? Send us a message.</p>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="cname" name="name" placeholder="Name *" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" name="email" placeholder="Email *" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="cphone" name="phone" placeholder="Phone">
                            </div>

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" id="csubject" name="subject" placeholder="Subject">
                            </div>
                        </div>

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" name="message" required placeholder="Message *"></textarea>

                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>SUBMIT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
