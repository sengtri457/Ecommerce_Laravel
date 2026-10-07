@extends('layouts.account')

@section('account_content')
<div class="dashboard-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="title mb-0">My Addresses</h3>
        <button class="btn btn-outline-primary-2 btn-sm" type="button" data-toggle="collapse" data-target="#new-address-form">
            <i class="icon-plus"></i> Add New Address
        </button>
    </div>

    <!-- New Address Form (Collapsible) -->
    <div class="collapse mb-4" id="new-address-form">
        <div class="card card-body bg-light">
            <h4 class="mb-3">Add New Address</h4>
            <form action="{{ route('account.addresses.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label>Address Label (e.g. Home, Office) *</label>
                        <input type="text" name="label" class="form-control" required placeholder="Home">
                    </div>
                    <div class="col-sm-6">
                        <label>Recipient Full Name *</label>
                        <input type="text" name="full_name" class="form-control" required value="{{ Auth::user()->name }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" class="form-control" required value="{{ Auth::user()->phone }}">
                    </div>
                    <div class="col-sm-6">
                        <label>Street Address Line 1 *</label>
                        <input type="text" name="line1" class="form-control" required placeholder="123 Main St">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Address Line 2 (Apartment, Suite)</label>
                        <input type="text" name="line2" class="form-control" placeholder="Apt 4B">
                    </div>
                    <div class="col-sm-6">
                        <label>City *</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label>State / Province</label>
                        <input type="text" name="state" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label>Postal Code *</label>
                        <input type="text" name="postal_code" class="form-control" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Country *</label>
                        <input type="text" name="country" class="form-control" value="United States" required>
                    </div>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="is_default" name="is_default" value="1">
                    <label class="custom-control-label" for="is_default">Set as default shipping address</label>
                </div>

                <button type="submit" class="btn btn-primary">Save Address</button>
            </form>
        </div>
    </div>

    <!-- Existing Addresses Cards -->
    <div class="row">
        @forelse($addresses as $addr)
            <div class="col-lg-6 mb-3">
                <div class="card card-dashboard h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $addr->label }}
                            @if($addr->is_default)
                                <span class="badge badge-success ml-2">Default</span>
                            @endif
                        </h4>

                        <p>
                            <strong>{{ $addr->full_name }}</strong><br>
                            {{ $addr->formatted_address }}<br>
                            Phone: {{ $addr->phone }}
                        </p>

                        <div class="mt-3">
                            <form action="{{ route('account.addresses.destroy', $addr->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this address?');">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">You have no saved addresses yet. Click "Add New Address" above to save one.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
