@extends('layouts.app')

@section('content')
<main class="main">
    @include('home._hero')
    @include('home._popular-categories')
    @include('home._promo-banners')

    @if(isset($homeSections))
        @foreach($homeSections as $section)
            @include('home._product-section', ['section' => $section])
        @endforeach
    @endif

    @include('home._brands')
    @include('home._newsletter')
    @include('home._latest-posts')
    @include('home._features')
</main>
@endsection
