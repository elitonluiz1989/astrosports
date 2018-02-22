@if (null != $links)
    @php
        $navClass = (isset($bottom) && $bottom) ?'pagination--bottom' : 'pagination--top';
        $navClass .= ' row row justify-content-center';
    @endphp
    <nav aria-label="Photos page navigation" class="{{ $navClass }}">
        {{ $links }}
    </nav>
@endif
