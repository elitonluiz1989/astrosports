@if (null != $links)
    @php $rowClass = (isset($bottom) && $bottom) ? 'pagination--bottom row' : 'row'; @endphp
    <div class="{{ $rowClass }}">
        <nav aria-label="Page navigation" class="pagination--centered col-12">
            {{ $links }}
        </nav>
    </div>
@endif
