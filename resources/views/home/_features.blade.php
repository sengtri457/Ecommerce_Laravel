@if(isset($features) && $features->count() > 0)
    <div class="py-4 my-4" style="background-color: #F4F4F0; border-top: 1px solid #E6E6E2; border-bottom: 1px solid #E6E6E2;">
        <div class="container">
            <div class="row">
                @foreach($features as $feat)
                    <div class="col-sm-6 col-lg-3 py-3">
                        <div class="d-flex align-items-center">
                            <span class="mr-3 text-primary d-flex align-items-center justify-content-center" style="font-size: 2.4rem; min-width: 44px;">
                                <i class="{{ $feat->icon }}"></i>
                            </span>

                            <div>
                                <h4 class="mb-1" style="font-size: 1.35rem; font-weight: 600; color: #1A1A1A; font-family: 'Inter', sans-serif;">
                                    {{ $feat->title }}
                                </h4>
                                <p class="mb-0 text-muted" style="font-size: 1.2rem; line-height: 1.4;">
                                    {{ $feat->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
