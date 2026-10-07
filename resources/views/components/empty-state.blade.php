@props([
    'icon' => 'icon-shopping-cart',
    'title' => 'No items found',
    'message' => 'There are currently no items to display in this list.',
    'buttonText' => 'Return to Shop',
    'buttonUrl' => route('shop.index'),
])

<div class="text-center py-5">
    <i class="{{ $icon }}" style="font-size: 4rem; color: #ccc;"></i>
    <h3 class="mt-3 mb-2">{{ $title }}</h3>
    <p class="text-muted mb-4">{{ $message }}</p>
    <a href="{{ $buttonUrl }}" class="btn btn-outline-primary-2 btn-round">
        <span>{{ $buttonText }}</span>
        <i class="icon-long-arrow-right"></i>
    </a>
</div>
