<aside class="col-lg-3">
    <div class="sidebar">
        <div class="widget widget-search">
            <h3 class="widget-title">Search</h3>
            <form action="{{ route('blog.index') }}" method="GET">
                <label for="ws" class="sr-only">Search in blog</label>
                <input type="search" class="form-control" name="q" id="ws" placeholder="Search in blog" value="{{ request('q') }}" required>
                <button type="submit" class="btn"><i class="icon-search"></i><span class="sr-only">Search</span></button>
            </form>
        </div>

        <div class="widget widget-cats">
            <h3 class="widget-title">Categories</h3>
            <ul>
                @if(isset($blogCategories))
                    @foreach($blogCategories as $bCat)
                        <li>
                            <a href="{{ route('blog.category', $bCat->slug) }}">
                                {{ $bCat->name }}
                                <span>{{ $bCat->posts_count }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="widget">
            <h3 class="widget-title">Popular Posts</h3>
            <ul class="posts-list">
                @if(isset($recentPosts))
                    @foreach($recentPosts as $rPost)
                        <li>
                            <figure>
                                <a href="{{ route('blog.show', $rPost->slug) }}">
                                    <img src="{{ asset($rPost->image) }}" alt="{{ $rPost->title }}">
                                </a>
                            </figure>
                            <div>
                                <span>{{ $rPost->published_at ? $rPost->published_at->format('M d, Y') : $rPost->created_at->format('M d, Y') }}</span>
                                <h4><a href="{{ route('blog.show', $rPost->slug) }}">{{ $rPost->title }}</a></h4>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="widget widget-banner-sidebar">
            <div class="banner-sidebar-title">ad banner 280 x 280</div>
            <div class="banner-sidebar banner-overlay">
                <a href="{{ route('shop.index') }}">
                    <img src="{{ asset('assets/images/blog/sidebar/banner.jpg') }}" alt="banner">
                </a>
            </div>
        </div>

        <div class="widget widget-tag">
            <h3 class="widget-title">Browse Tags</h3>
            <div class="tagcloud">
                @if(isset($blogTags))
                    @foreach($blogTags as $bTag)
                        <a href="{{ route('blog.tag', $bTag->slug) }}">{{ $bTag->name }}</a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</aside>
