@if(isset($slides) && $slides->count() > 0)
    <div class="intro-slider-container mb-4">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                "nav": false,
                "dots": true,
                "responsive": {
                    "992": {
                        "nav": true
                    }
                }
            }'>
            @foreach($slides as $slide)
                @php
                    $dollars = $slide->price ? floor($slide->price) : null;
                    $cents = $slide->price ? sprintf('%02d', round(($slide->price - $dollars) * 100)) : null;
                @endphp
                <div class="intro-slide" style="background-image: url('{{ asset($slide->image) }}'); background-size: cover; background-position: center; min-height: 480px; display: flex; align-items: center;">
                    <div class="container intro-content">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 intro-col p-4 p-md-5" style="background: rgba(250, 250, 248, 0.92); backdrop-filter: blur(8px); border-radius: 4px; border: 1px solid rgba(230, 230, 226, 0.8);">
                                @if($slide->subtitle)
                                    <span class="intro-subtitle text-primary text-uppercase font-weight-600 mb-2 d-inline-block" style="letter-spacing: 0.18em; font-size: 1.15rem;">
                                        {{ $slide->subtitle }}
                                    </span>
                                @endif
                                <h1 class="intro-title mb-3" style="font-size: 3.2rem; line-height: 1.15; color: #1A1A1A; font-family: 'Playfair Display', serif;">
                                    {!! nl2br(e($slide->title)) !!}
                                </h1>

                                @if($slide->price)
                                    <div class="intro-price text-muted mb-4" style="font-size: 1.4rem;">
                                        @if($slide->price_prefix)
                                            <span class="font-weight-light">{{ $slide->price_prefix }}</span>
                                        @endif
                                        <span class="text-primary font-weight-600">${{ $dollars }}<sup>.{{ $cents }}</sup></span>
                                    </div>
                                @endif

                                @if($slide->button_url)
                                    <a href="{{ url($slide->button_url) }}" class="btn btn-primary" style="padding: 12px 28px; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; font-size: 1.25rem;">
                                        <span>{{ $slide->button_text ?: 'Explore Collection' }}</span>
                                        <i class="icon-long-arrow-right ml-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <span class="slider-loader"></span>
    </div>
@endif
