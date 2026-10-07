@if(isset($featuredCategories) && $featuredCategories->count() > 0)
    <div class="mb-4"></div>

    <div class="container">
        <h2 class="title text-center mb-2">Explore Popular Categories</h2>

        <div class="cat-blocks-container">
            <div class="row">
                @foreach($featuredCategories as $category)
                    <div class="col-6 col-sm-4 col-lg-2">
                        <a href="{{ route('shop.category', $category->slug) }}" class="cat-block">
                            <figure>
                                <span>
                                    <img src="{{ asset($category->image ?? 'assets/images/demos/demo-13/cats/1.jpg') }}" alt="{{ $category->name }}">
                                </span>
                            </figure>

                            <h3 class="cat-block-title">{{ $category->name }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
