@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => $post->title,
        'subtitle' => $post->category?->name,
        'breadcrumbs' => [
            ['label' => 'Blog', 'url' => route('blog.index')],
            ['label' => $post->category?->name ?? 'Article', 'url' => route('blog.category', $post->category->slug)],
            ['label' => $post->title, 'url' => '']
        ]
    ])

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                        </figure>

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#">{{ $post->author?->name ?? 'Admin' }}</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</a>
                                <span class="meta-separator">|</span>
                                <a href="#comments">{{ $post->comments->count() }} Comments</a>
                            </div>

                            <h2 class="entry-title">{{ $post->title }}</h2>

                            <div class="entry-cats">
                                in <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
                            </div>

                            <div class="entry-content editor-content">
                                {!! $post->content !!}
                            </div>

                            <div class="entry-footer row no-gutters pr-1">
                                <div class="col">
                                    <div class="entry-tags">
                                        <span>Tags:</span>
                                        @foreach($post->tags as $tag)
                                            <a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Prev/Next Navigation -->
                    <nav class="pager-nav mb-5" aria-label="Page navigation">
                        @if($prevPost)
                            <a class="pager-link pager-link-prev" href="{{ route('blog.show', $prevPost->slug) }}" aria-label="Previous">
                                Previous Post
                                <span class="pager-link-title">{{ $prevPost->title }}</span>
                            </a>
                        @endif

                        @if($nextPost)
                            <a class="pager-link pager-link-next" href="{{ route('blog.show', $nextPost->slug) }}" aria-label="Next">
                                Next Post
                                <span class="pager-link-title">{{ $nextPost->title }}</span>
                            </a>
                        @endif
                    </nav>

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                        <div class="related-posts mb-5">
                            <h3 class="title">Related Posts</h3>
                            <div class="row">
                                @foreach($relatedPosts as $rPost)
                                    <div class="col-md-4 mb-3">
                                        <x-blog-card :post="$rPost" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Comments Section -->
                    <div class="comments" id="comments">
                        <h3 class="title">{{ $post->comments->count() }} Comments</h3>

                        <ul>
                            @foreach($post->comments as $comment)
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <img src="{{ asset('assets/images/testimonials/user-1.jpg') }}" alt="{{ $comment->name }}">
                                        </figure>

                                        <div class="comment-body">
                                            <div class="comment-user">
                                                <h4><a href="#">{{ $comment->name }}</a></h4>
                                                <span class="comment-date">{{ $comment->created_at->format('M d, Y \a\t h:i A') }}</span>
                                            </div>

                                            <div class="comment-content">
                                                <p>{{ $comment->body }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($comment->replies->count() > 0)
                                        <ul>
                                            @foreach($comment->replies as $reply)
                                                <li>
                                                    <div class="comment">
                                                        <figure class="comment-media">
                                                            <img src="{{ asset('assets/images/testimonials/user-2.jpg') }}" alt="{{ $reply->name }}">
                                                        </figure>

                                                        <div class="comment-body">
                                                            <div class="comment-user">
                                                                <h4><a href="#">{{ $reply->name }}</a></h4>
                                                                <span class="comment-date">{{ $reply->created_at->format('M d, Y \a\t h:i A') }}</span>
                                                            </div>

                                                            <div class="comment-content">
                                                                <p>{{ $reply->body }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Leave a Comment -->
                    <div class="reply mt-4">
                        <div class="heading">
                            <h3 class="title">Leave A Reply</h3>
                            <p class="title-desc">Your email address will not be published. Required fields are marked *</p>
                        </div>

                        <form action="{{ route('blog.comment', $post->slug) }}" method="POST">
                            @csrf
                            <label for="cname" class="sr-only">Name</label>
                            <input type="text" class="form-control" id="cname" name="name" required placeholder="Name *">

                            <label for="cemail" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="cemail" name="email" required placeholder="Email *">

                            <label for="cmessage" class="sr-only">Comment</label>
                            <textarea name="body" cols="30" rows="4" class="form-control" required placeholder="Comment *"></textarea>

                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>SUBMIT COMMENT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                @include('partials.blog-sidebar')
            </div>
        </div>
    </div>
@endsection
