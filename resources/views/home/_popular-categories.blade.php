@if(isset($featuredCategories) && $featuredCategories->count() > 0)
    <div class="mb-4"></div>

    <div class="container">
        <h2 class="title text-center mb-2">Explore Curated Categories</h2>

        <div class="cat-blocks-container">
            <div class="row">
                @foreach($featuredCategories as $category)
                    <div class="col-12 col-md-4 mb-3">
                        <a href="{{ route('shop.category', $category->slug) }}" class="cat-block p-4" style="background: #ffffff; border: 1px solid #e6e6e2; border-radius: 6px; display: block; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <figure class="mb-3" style="overflow: hidden; border-radius: 4px; aspect-ratio: 4 / 3;">
                                <img src="{{ asset($category->image ?? 'assets/images/mainImages/products/image1.jpg') }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </figure>

                            <h3 class="cat-block-title mb-1" style="font-size: 1.6rem; font-family: 'Playfair Display', serif; color: #1A1A1A;">{{ $category->name }}</h3>
                            <span class="text-primary text-uppercase font-weight-500" style="font-size: 1.15rem; letter-spacing: 0.08em;">Explore Collection &rarr;</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
