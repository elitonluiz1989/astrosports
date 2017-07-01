@include('partials.pagination-bar', $pagination)

<div class="row">
    @foreach ($contents as $id => $content)
        <div class="col-xs-12 col-sm-4 col-md-3">
            @php
            $elementId = $target . '-' . $id;
            $elementSrc = $content['src'] ?? $content['cover'];

            $elementUrl = $pagination['url'] . '/' . $elementId;
            @endphp

            <a href="{{ $elementUrl }}" class="photo" id="{{ $elementId }}">
                <img src="{{ $elementSrc }}?w=300&h=250" alt="{{ $photo['description'] or 'Sem imgagem' }}" class="photo-content">
            </a>
        </div>
    @endforeach
</div>

@include('partials.pagination-bar', $pagination)
