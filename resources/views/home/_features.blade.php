@if(isset($features) && $features->count() > 0)
    <div class="icon-boxes-container">
        <div class="container">
            <div class="row">
                @foreach($features as $feat)
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon">
                                <i class="{{ $feat->icon }}"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">{{ $feat->title }}</h3>
                                <p>{{ $feat->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
