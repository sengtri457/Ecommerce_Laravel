@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'My Account',
        'subtitle' => 'Manage your orders, profile, and addresses',
        'breadcrumbs' => [
            ['label' => 'Account', 'url' => route('account.dashboard')]
        ]
    ])

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('partials.account-sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            @yield('account_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
