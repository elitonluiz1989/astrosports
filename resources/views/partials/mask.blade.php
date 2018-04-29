@php
    $maskId = $maskId ?? 'mask-' . rand();
    $maskType = $maskType ?? 'mask--dark';
    $loaderMessage = $loaderMessage ?? null;
@endphp
<div id="{{ $maskId }}" class="mask">
    <div class="mask__content {{ $maskType }}">
        <div class="loader loader--floating loader--show">
            <div class="spinner"></div>

            @if($loaderMessage)
                <p class="loader__message"></p>
            @endif
        </div>
    </div>
</div>