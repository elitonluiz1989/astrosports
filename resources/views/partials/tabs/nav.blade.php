@php
    /**
    * Nav tab need an array settings when included, containg:
    * @key string navId
    * @key string customClass
    * @key string navItemPrefix
    * @key array navItems
    * @key string|int target
    */

    $navClass = 'nav nav-tabs col-12';
    if (isset($customClass)) {
        $navClass .= ' ' . $customClass;
    } else {
        $navClass .= ' ' . $navId;
    }

    $target = $target ?? key($navItems);
@endphp

<ul id="{{ $navId }}" class="{{ $navClass }}" role="tablist">
    @foreach ($navItems as $navItem => $navItemContent)
        @php
            $navLinkClass = 'nav-link';

            if ($navItem == $target) {
                $navLinkClass .= ' active';
                $isSelected = true;
            } else {
                $isSelected = false;
            }

            $navItemId = $navItem;
            if (isset($navItemPrefix)) {
                $navItemId = $navItemPrefix . '-' . $navItemId;
                $navItemLink = '#' . $navItemPrefix . '-';
            } else {
                $navItemLink = '#';
            }

            if (is_array($navItemContent)) {
                $navItemLink = $navItemContent['url'];
                $navItemText = $navItemContent['text'];
            } else {
                $navItemLink .= $navItem;
                $navItemText = $navItemContent;
            }
        @endphp

        <li class="nav-item">
            <a id="{{ $navItemId }}-tab" class="{{ $navLinkClass }}"
               href="{{ $navItemLink }}"
               data-toggle="tab"
               role="tab"
               aria-controls="{{ $navItem }}"
               aria-selected="{{ $isSelected }}">{{ $navItemText }}</a>
        </li>
    @endforeach
</ul>