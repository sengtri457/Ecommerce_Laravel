@if(isset($promoBanners) && $promoBanners->count() > 0)
    <div class="container my-5">
        <div class="row">
            @foreach($promoBanners as $banner)
                <div class="{{ $banner->column_class ?: 'col-md-6' }} mb-4 mb-md-0">
                    <div class="banner banner-overlay" style="border-radius: 6px; overflow: hidden; position: relative; background: #f4f4f0;">
                        <a href="{{ url($banner->button_url ?? '#') }}" style="display: block; width: 100%; height: 100%;">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" style="width: 100%; height: auto; object-fit: cover; max-height: 440px; display: block;">
                        </a>

                        <div class="banner-content p-4 p-md-5" style="background: linear-gradient(to top, rgba(26,26,26,0.85) 0%, rgba(26,26,26,0.2) 65%, transparent 100%);">
                            @if($banner->subtitle)
                                <h4 class="banner-subtitle text-uppercase font-weight-500 mb-2" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #FAFAF8;">
                                    <a href="{{ url($banner->button_url ?? '#') }}" class="text-white">{{ $banner->subtitle }}</a>
                                </h4>
                            @endif
                            <h3 class="banner-title text-white mb-3" style="font-size: 2.2rem; font-family: 'Playfair Display', serif; line-height: 1.25;">
                                <a href="{{ url($banner->button_url ?? '#') }}" class="text-white">
                                    {!! nl2br(e($banner->title)) !!}
                                    @if($banner->description)
                                        <br><span style="font-family: 'Inter', sans-serif; font-size: 1.25rem; font-weight: 300; opacity: 0.9;">{{ $banner->description }}</span>
                                    @endif
                                </a>
                            </h3>
                            @if($banner->button_url)
                                <a href="{{ url($banner->button_url) }}" class="btn btn-outline-white-2" style="border-radius: 3px; padding: 9px 22px; font-size: 1.15rem; letter-spacing: 0.08em; text-transform: uppercase;">
                                    <span>{{ $banner->button_text ?: 'Explore' }}</span>
                                    <i class="icon-long-arrow-right ml-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
