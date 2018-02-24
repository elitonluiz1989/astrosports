@php
    $tabItemClass = 'tab-pane fade';

    if (isset($isActive) && $isActive) {
        $tabItemClass .= ' show active';
    }

    if (isset($customClass)) {
        $tabItemClass .= ' ' . $customClass;
    }

    $labelledBy = $labelledBy ?? $tabContentId;
@endphp

<div id="{{ $tabContentId }}"
     class="{{ $tabItemClass }}"
     role="tabpanel"
     aria-labelledby="{{ $labelledBy }}-tab">
    {{ $slot }}
</div>
