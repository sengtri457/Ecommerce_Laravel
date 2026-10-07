@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Sign In',
        'subtitle' => 'Access your account to manage orders and profile',
        'breadcrumbs' => [
            ['label' => 'Login', 'url' => route('login')]
        ]
    ])

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab-link" data-toggle="tab" href="#signin-tab" role="tab" aria-controls="signin-tab" aria-selected="true">Sign In</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="signin-tab" role="tabpanel" aria-labelledby="signin-tab-link">
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="singin-email">Email address *</label>
                                    <input type="email" class="form-control" id="singin-email" name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="singin-password">Password *</label>
                                    <input type="password" class="form-control" id="singin-password" name="password" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember" name="remember">
                                        <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <p>Don't have an account? <a href="{{ route('register') }}" class="font-weight-bold text-primary">Sign up here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
