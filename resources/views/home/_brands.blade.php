@if(isset($brands) && $brands->count() > 0)
    <div class="container mb-5">
        <h2 class="title text-center mb-4">Shop by Brand</h2>
        <div class="owl-carousel mt-3 mb-3 owl-simple" data-toggle="owl" 
            data-owl-options='{
                "nav": false, 
                "dots": false,
                "margin": 30,
                "loop": false,
                "responsive": {
                    "0": { "items":2 },
                    "420": { "items":3 },
                    "600": { "items":4 },
                    "900": { "items":5 },
                    "1024": { "items":6 }
                }
            }'>
            @foreach($brands as $brand)
                <a href="{{ route('shop.index', ['brand' => [$brand->slug]]) }}" class="brand py-3 text-center">
                    @if($brand->logo)
                        <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                    @else
                        <h5>{{ $brand->name }}</h5>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endif
