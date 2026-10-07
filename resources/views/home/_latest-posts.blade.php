@if(isset($latestPosts) && $latestPosts->count() > 0)
    <div class="blog-posts bg-light pt-5 pb-5">
        <div class="container">
            <h2 class="title text-center mb-4">From Our Blog</h2>

            <div class="row justify-content-center">
                @foreach($latestPosts as $post)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <x-blog-card :post="$post" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
