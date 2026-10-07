@props([
    'title' => 'Page Title',
    'subtitle' => null,
    'image' => 'assets/images/page-header-bg.jpg',
    'breadcrumbs' => [],
])

<div class="page-header text-center" style="background-image: url('{{ asset($image) }}')">
    <div class="container">
        <h1 class="page-title">{{ $title }}@if($subtitle)<span>{{ $subtitle }}</span>@endif</h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            @foreach($breadcrumbs as $crumb)
                @if(!empty($crumb['url']) && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $crumb['label'] }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
