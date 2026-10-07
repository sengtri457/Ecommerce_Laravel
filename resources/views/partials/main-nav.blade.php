<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            @include('partials.category-sidebar')
        </div>

        <div class="header-center">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    @if(isset($mainMenu) && $mainMenu->items)
                        @foreach($mainMenu->items as $item)
                            @php
                                $path = ltrim($item->url, '/');
                                $isActive = ($path === '' && request()->is('/')) || ($path !== '' && request()->is($path . '*'));
                                $hasChildren = $item->children && $item->children->count() > 0;
                            @endphp
                            <li class="{{ $isActive ? 'active' : '' }}">
                                <a href="{{ url($item->url) }}" class="{{ $hasChildren ? 'sf-with-ul' : '' }}">{{ $item->label }}</a>
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
                <i class="{{ $promo->icon ?: 'la la-lightbulb-o' }}"></i>
                <p><a href="{{ url($promo->url) }}" class="text-white">{{ $promo->label }}</a></p>
            @endif
        </div>
    </div>
</div>
