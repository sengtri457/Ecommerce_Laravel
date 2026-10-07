@extends('layouts.account')

@section('account_content')
<div class="dashboard-content">
    <h3 class="title mb-4">Account Details</h3>

    <form action="{{ route('account.profile.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="acc-name">Full Name *</label>
            <input type="text" class="form-control" id="acc-name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="acc-email">Email Address *</label>
            <input type="email" class="form-control" id="acc-email" value="{{ $user->email }}" disabled>
            <small class="form-text text-muted">Email address cannot be changed directly.</small>
        </div>

        <div class="form-group">
            <label for="acc-phone">Phone Number</label>
            <input type="tel" class="form-control" id="acc-phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <hr class="my-4">
        <h4>Change Password</h4>
        <small class="text-muted d-block mb-3">Leave blank if you do not want to change your password.</small>

        <div class="form-group">
            <label for="acc-cur-pass">Current Password</label>
            <input type="password" class="form-control" id="acc-cur-pass" name="current_password">
        </div>

        <div class="form-group">
            <label for="acc-new-pass">New Password (min 6 characters)</label>
            <input type="password" class="form-control" id="acc-new-pass" name="password">
        </div>

        <div class="form-group">
            <label for="acc-conf-pass">Confirm New Password</label>
            <input type="password" class="form-control" id="acc-conf-pass" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-outline-primary-2 mt-2">
            <span>SAVE CHANGES</span>
            <i class="icon-long-arrow-right"></i>
        </button>
    </form>
</div>
@endsection
