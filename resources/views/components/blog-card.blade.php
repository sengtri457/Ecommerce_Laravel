@props(['post'])

<article class="entry">
    <figure class="entry-media">
        <a href="{{ route('blog.show', $post->slug) }}">
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
        </a>
    </figure>

    <div class="entry-body">
        <div class="entry-meta">
            <span class="entry-author">
                by <a href="#">{{ $post->author?->name ?? 'Admin' }}</a>
            </span>
            <span class="meta-separator">|</span>
            <a href="#">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</a>
            <span class="meta-separator">|</span>
            <a href="{{ route('blog.show', $post->slug) }}#comments">{{ $post->comments->count() }} Comments</a>
        </div>

        <h2 class="entry-title">
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h2>

        <div class="entry-cats">
            in <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
        </div>

        <div class="entry-content">
            <p>{{ $post->excerpt }}</p>
            <a href="{{ route('blog.show', $post->slug) }}" class="read-more">Read More</a>
        </div>
    </div>
</article>
