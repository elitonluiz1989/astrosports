@php
    $tabLinkClass = 'nav-link';

    if (isset($isActive)) {
        $tabLinkClass .= ' show active';
    }

    $tabItemTarget = $tabItemTarget ?? $tabItemId;
@endphp

<li class="nav-item">
    <a id="{{ $tabItemId }}-tab" class="{{ $tabLinkClass }}" href="#{{ $tabItemTarget }}" data-toggle="tab"  role="tab" aria-controls="{{ $tabItemTarget }}" aria-selected="true">{{ $tabItemText }}</a>
</li>