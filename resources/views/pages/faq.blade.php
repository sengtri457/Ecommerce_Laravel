@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => $page->title ?? 'F.A.Q',
        'subtitle' => $page->subtitle ?? 'Frequently Asked Questions',
        'image' => $page?->banner_image ?: 'assets/images/page-header-bg.jpg',
        'breadcrumbs' => [
            ['label' => 'FAQ', 'url' => route('faq.index')]
        ]
    ])

    <div class="page-content">
        <div class="container">
            @foreach($categories as $category)
                <h2 class="title text-center mb-3 mt-4">{{ $category->name }}</h2>

                <div class="accordion accordion-rounded" id="accordion-{{ $category->id }}">
                    @foreach($category->faqs as $faq)
                        <div class="card card-box card-sm bg-light mb-2">
                            <div class="card-header" id="heading-{{ $faq->id }}">
                                <h2 class="card-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-{{ $faq->id }}" aria-expanded="false" aria-controls="collapse-{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </a>
                                </h2>
                            </div>
                            <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading-{{ $faq->id }}" data-parent="#accordion-{{ $category->id }}">
                                <div class="card-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
