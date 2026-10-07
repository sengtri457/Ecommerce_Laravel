@if(isset($promoBanners) && $promoBanners->count() > 0)
    <div class="mb-2"></div>

    <div class="container">
        <div class="row">
            @foreach($promoBanners as $banner)
                <div class="{{ $banner->column_class ?: 'col-lg-3 col-sm-6' }}">
                    <div class="banner banner-overlay">
                        <a href="{{ url($banner->button_url ?? '#') }}">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                        </a>

                        <div class="banner-content">
                            @if($banner->subtitle)
                                <h4 class="banner-subtitle text-white">
                                    <a href="{{ url($banner->button_url ?? '#') }}">{{ $banner->subtitle }}</a>
                                </h4>
                            @endif
                            <h3 class="banner-title text-white">
                                <a href="{{ url($banner->button_url ?? '#') }}">
                                    {!! nl2br(e($banner->title)) !!}
                                    @if($banner->description)
                                        <br><span>{{ $banner->description }}</span>
                                    @endif
                                </a>
                            </h3>
                            @if($banner->button_url)
                                <a href="{{ url($banner->button_url) }}" class="banner-link">
                                    {{ $banner->button_text ?: 'Shop Now' }} <i class="icon-long-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
