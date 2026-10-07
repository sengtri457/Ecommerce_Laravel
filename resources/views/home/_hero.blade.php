@if(isset($slides) && $slides->count() > 0)
    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                "nav": false,
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
                <div class="intro-slide" style="background-image: url('{{ asset($slide->image) }}');">
                    <div class="container intro-content">
                        <div class="row">
                            <div class="col-auto offset-lg-3 intro-col">
                                @if($slide->subtitle)
                                    <h3 class="intro-subtitle">{{ $slide->subtitle }}</h3>
                                @endif
                                <h1 class="intro-title">
                                    {!! nl2br(e($slide->title)) !!}
                                    @if($slide->price)
                                        <span>
                                            @if($slide->price_prefix)
                                                <sup class="font-weight-light">{{ $slide->price_prefix }}</sup>
                                            @endif
                                            <span class="text-primary">${{ $dollars }}<sup>,{{ $cents }}</sup></span>
                                        </span>
                                    @endif
                                </h1>

                                @if($slide->button_url)
                                    <a href="{{ url($slide->button_url) }}" class="btn btn-outline-primary-2">
                                        <span>{{ $slide->button_text ?: 'Shop Now' }}</span>
                                        <i class="icon-long-arrow-right"></i>
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
