@php
    if ($records->total() > $limit) {
        $pagination['links'] = $records->links();
    }
@endphp

@include('partials.pagination-bar', $pagination)

<div class="row">
    @foreach ($records as $record)
        <div class="col-xs-12 col-sm-4 col-md-3">
            <a href="{{ $record->url }}" class="photo" id="{{ $record->id }}">
                <img src="{{ $record->img }}" alt="{{ $record->alt }}" class="photo__content">

                @if (isset($showAlbumName))
                    <div class="photo__album-name col-xs-12">{{ $record->name }}</div>
                @endif
            </a>
        </div>
    @endforeach
</div>

@include('partials.pagination-bar-bottom', $pagination)
