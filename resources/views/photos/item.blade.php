@php
    $showAlbumName = $isAlbum ?? false;
@endphp

@include('partials.pagination-bar', $pagination)

<div class="row">
    <div id="photos-modal" class="photos__modal modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="photos__modal-header modal-header">
                    <button type="button" class="close">&times;</button>
                </div>

                <div class="modal-body">
                    <img>
                </div>
            </div>

        </div>
    </div>

    @foreach ($records as $record)
        <div class="col-xs-12 col-sm-4 col-md-3">
            <a href="{{ $record->link }}" id="{{ $record->id }}" class="photo{{ ($showAlbumName) ? ' is-album' : null  }}">
                <img src="{{ $record->source }}" alt="{{ $record->alt }}" class="photo__content">

                @if ($showAlbumName)
                    <div class="photo__album-name col-xs-12">{{ $record->name }}</div>
                @endif
            </a>
        </div>
    @endforeach
</div>

@include('partials.pagination-bar-bottom', $pagination)
