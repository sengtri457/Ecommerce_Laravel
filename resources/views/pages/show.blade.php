@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => $page->title,
        'subtitle' => $page->subtitle,
        'image' => $page->banner_image ?: 'assets/images/page-header-bg.jpg',
        'breadcrumbs' => [
            ['label' => $page->title, 'url' => '']
        ]
    ])

    <div class="page-content py-4">
        <div class="container">
            <div class="card p-5 bg-white border">
                <div class="entry-content editor-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
