@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Sign Up',
        'subtitle' => 'Register a new customer account',
        'breadcrumbs' => [
            ['label' => 'Register', 'url' => route('register')]
        ]
    ])

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab-link" data-toggle="tab" href="#register-tab" role="tab" aria-controls="register-tab" aria-selected="true">Register</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="register-tab" role="tabpanel" aria-labelledby="register-tab-link">
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="register-name">Full Name *</label>
                                    <input type="text" class="form-control" id="register-name" name="name" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="register-email">Your email address *</label>
                                    <input type="email" class="form-control" id="register-email" name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="register-phone">Phone number</label>
                                    <input type="tel" class="form-control" id="register-phone" name="phone" value="{{ old('phone') }}">
                                </div>

                                <div class="form-group">
                                    <label for="register-password">Password *</label>
                                    <input type="password" class="form-control" id="register-password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="register-password-confirm">Confirm Password *</label>
                                    <input type="password" class="form-control" id="register-password-confirm" name="password_confirmation" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2 btn-block">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <p>Already have an account? <a href="{{ route('login') }}" class="font-weight-bold text-primary">Log in here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
