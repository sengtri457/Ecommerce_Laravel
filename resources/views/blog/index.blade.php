@extends('layouts.app')

@section('content')
    @php
        $title = $currentCategory ? $currentCategory->name : ($currentTag ? '#' . $currentTag->name : 'From Our Blog');
        $crumbs = [
            ['label' => 'Blog', 'url' => route('blog.index')]
        ];
        if ($currentCategory) {
            $crumbs[] = ['label' => $currentCategory->name, 'url' => ''];
        } elseif ($currentTag) {
            $crumbs[] = ['label' => '#' . $currentTag->name, 'url' => ''];
        }
    @endphp

    @include('partials.page-header', [
        'title' => $title,
        'subtitle' => 'News, tech insights, and lifestyle trends',
        'breadcrumbs' => $crumbs
    ])

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @if($posts->count() > 0)
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-md-6 mb-4">
                                    <x-blog-card :post="$post" />
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <x-empty-state 
                            icon="icon-file-text"
                            title="No blog posts found"
                            message="There are currently no articles in this section."
                            buttonText="Return to Blog"
                            :buttonUrl="route('blog.index')"
                        />
                    @endif
                </div>

                @include('partials.blog-sidebar')
            </div>
        </div>
    </div>
@endsection
