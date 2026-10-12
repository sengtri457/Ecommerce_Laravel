<div class="header-bottom sticky-header" style="background: #ffffff; border-top: 1px solid #f0f0ec; border-bottom: 1px solid #e6e6e2;">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="header-center mx-0">
            <nav class="main-nav">
                <ul class="menu sf-arrows d-flex align-items-center mb-0">
                    @if(isset($mainMenu) && $mainMenu->items)
                        @foreach($mainMenu->items as $item)
                            @php
                                $path = ltrim($item->url, '/');
                                $isActive = ($path === '' && request()->is('/')) || ($path !== '' && request()->is($path . '*'));
                                $hasChildren = $item->children && $item->children->count() > 0;
                            @endphp
                            <li class="{{ $isActive ? 'active' : '' }}">
                                <a href="{{ url($item->url) }}" class="{{ $hasChildren ? 'sf-with-ul' : '' }}" style="font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; font-size: 1.25rem;">
                                    {{ $item->label }}
                                </a>
                                @if($hasChildren)
                                    <ul>
                                        @foreach($item->children as $child)
                                            <li>
                                                <a href="{{ url($child->url) }}">{{ $child->label }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>

        <div class="header-right">
            @if(isset($promoMenu) && $promoMenu->items->first())
                @php $promo = $promoMenu->items->first(); @endphp
                <div class="header-promo-badge d-flex align-items-center text-muted" style="font-size: 1.2rem; letter-spacing: 0.03em;">
                    <i class="{{ $promo->icon ?: 'la la-truck' }} mr-2 text-primary" style="font-size: 1.6rem;"></i>
                    <a href="{{ url($promo->url) }}" class="text-muted font-weight-500">{{ $promo->label }}</a>
                </div>
            @endif
        </div>
    </div>
</div>
