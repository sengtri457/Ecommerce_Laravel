@extends('layouts.app')

@section('content')
    <div class="error-content text-center py-5 my-5" style="background-image: url('{{ asset('assets/images/backgrounds/error-bg.jpg') }}')">
        <div class="container py-5">
            <h1 class="error-title display-1 font-weight-bold text-primary" style="font-size: 8rem;">404</h1>
            <h2 class="mt-2 mb-3">Error 404: Page Not Found</h2>
            <p class="text-muted mb-4 lead">We are sorry, the page you've requested is not available or has been relocated.</p>
            <a href="{{ route('home') }}" class="btn btn-outline-primary-2 btn-minwidth-lg btn-round">
                <span>BACK TO HOMEPAGE</span>
                <i class="icon-long-arrow-right"></i>
            </a>
        </div>
    </div>
@endsection
