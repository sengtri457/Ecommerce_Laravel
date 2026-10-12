@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Sign In',
        'subtitle' => 'Access your account to manage orders, wishlist and profile',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Login', 'url' => route('login')]
        ]
    ])

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('{{ asset('assets/images/backgrounds/login-bg.jpg') }}'); background-color: #f7f6f2;">
        <div class="container">
            <div class="form-box shadow-sm" style="background: #ffffff; border-radius: 12px; border: 1px solid #eaeaea;">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab-link" href="{{ route('login') }}" role="tab" aria-selected="true" style="font-weight: 600; font-size: 1.6rem;">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-muted" id="register-tab-link" href="{{ route('register') }}" role="tab" aria-selected="false" style="font-size: 1.6rem;">Register</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="signin-tab" role="tabpanel">
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="singin-email" class="font-weight-500">Email address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="singin-email" name="email" value="{{ old('email') }}" required autofocus placeholder="yourname@domain.com">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="singin-password" class="font-weight-500">Password *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="singin-password" name="password" required placeholder="Enter password">
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-footer d-flex align-items-center justify-content-between mb-4">
                                    <button type="submit" class="btn btn-outline-primary-2 px-4 py-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember" name="remember">
                                        <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <p class="mb-0 text-muted">Don't have an account? <a href="{{ route('register') }}" class="font-weight-bold text-primary">Sign up here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
