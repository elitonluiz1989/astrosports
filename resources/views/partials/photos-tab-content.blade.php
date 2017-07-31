@php
    if ($records->total() > $limit) {
        $pagination['content'] = $records->links();
    }
@endphp

@include('partials.pagination-bar', $pagination)

<div class="row">
    @foreach ($records as $record)
        @php $src = $record->cover . '?w=' . $cover['width'] . '&h=' . $cover['height']; @endphp
        <div class="col-xs-12 col-sm-4 col-md-3">
            <a href="{{ $record->url }}" class="photo" id="{{ $record->id }}">
                <img src="{{ $src }}" alt="{{ $record->alt }}" class="photo__content">
            </a>
        </div>
    @endforeach
</div>

@include('partials.pagination-bar', $pagination)
