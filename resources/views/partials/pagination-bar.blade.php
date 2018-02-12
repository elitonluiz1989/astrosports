@if (null != $links)
    @php
        $bottom = $bottom ?? false;

        $rowClass = ($bottom) ? 'pagination--bottom row' : 'row';
    @endphp

    <div class="{{ $rowClass }}">
        <nav aria-label="Page navigation" class="pagination--centered col-xs-12">
            {{ $links }}
        </nav>
    </div>
@endif
