@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Sign Up',
        'subtitle' => 'Register a new customer account to start shopping and tracking orders',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Register', 'url' => route('register')]
        ]
    ])

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('{{ asset('assets/images/backgrounds/login-bg.jpg') }}'); background-color: #f7f6f2;">
        <div class="container">
            <div class="form-box shadow-sm" style="background: #ffffff; border-radius: 12px; border: 1px solid #eaeaea;">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-muted" id="signin-tab-link" href="{{ route('login') }}" role="tab" aria-selected="false" style="font-size: 1.6rem;">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab-link" href="{{ route('register') }}" role="tab" aria-selected="true" style="font-weight: 600; font-size: 1.6rem;">Register</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="register-tab" role="tabpanel">
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="register-name" class="font-weight-500">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-name" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="register-email" class="font-weight-500">Your email address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email" name="email" value="{{ old('email') }}" required placeholder="yourname@domain.com">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="register-phone" class="font-weight-500">Phone number (Optional)</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="register-phone" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="register-password" class="font-weight-500">Password *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="register-password" name="password" required placeholder="At least 8 characters">
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="register-password-confirm" class="font-weight-500">Confirm Password *</label>
                                    <input type="password" class="form-control" id="register-password-confirm" name="password_confirmation" required placeholder="Repeat password">
                                </div>

                                <div class="form-footer mt-4">
                                    <button type="submit" class="btn btn-outline-primary-2 btn-block py-2">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}" class="font-weight-bold text-primary">Log in here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
