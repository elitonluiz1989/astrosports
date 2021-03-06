@php
    $isAlbum = $isAlbum ?? false;

    $recordClass = ($isAlbum) ? 'album' : 'photo';
@endphp

@include('partials.pagination-bar', $pagination)

<div class="photos-wrapper">
    @component('partials.modal')
        @slot('modalId', 'photos-modal')

        @slot('customClass', 'photos__modal')

        <img>
    @endcomponent

    @foreach ($records as $record)
        <div class="col-12 col-sm-4 col-md-3">
            <a id="{{ $record->id }}" class="{{ $recordClass }}" href="{{ $record->link }}">
                <img class="cover img-fluid" src="{{ $record->source }}" alt="{{ $record->alt }}">

                @if ($isAlbum)
                    <div class="album__name">{{ $record->name }}</div>
                @endif
            </a>
        </div>
    @endforeach
</div>

@include('partials.pagination-bar-bottom', $pagination)