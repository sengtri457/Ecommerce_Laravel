@props(['rating' => 0, 'count' => null])

@php
    $percent = min(100, max(0, ($rating / 5) * 100));
@endphp

<div class="ratings-container">
    <div class="ratings">
        <div class="ratings-val" style="width: {{ $percent }}%;"></div>
    </div>
    @if ($count !== null)
        <span class="ratings-text">( {{ $count }} Reviews )</span>
    @endif
</div>
