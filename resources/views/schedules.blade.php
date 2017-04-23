@extends('layout.app')

@section('title', 'Horários')

@section('content')
    <div class="photos page">
        @if ($albums)
            <div class="row">
                <ul class="photos__display-by nav nav-tabs">
                    @php
                        $displayByItem = "photos__display-item";

                        $scheduleClass = $displayByItem;
                        $poleClass = $displayByItem;

                        if ($display == 'poles')  {
                            $polesClass .= " active";
                        } else {
                            $schedulesClass .= " active";
                        }
                    @endphp
                    <li role="presentation" class="{{ $schedulesClass }}">
                        <a href="/horarios">Horários</a>
                    </li>
                    <li role="presentation" class="{{ $poleClass }}">
                        <a href="/horarios/polos">Polos</a>
                    </li>
                </ul>
            </div>
        @endif
        <div class="row">
            <nav aria-label="Page navigation" class="photos__navigation col-xs-12">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i < $qty; $i++)
                        <li>
                            <a href="/horarios/{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            @foreach ($photos as $id => $photo)
                <div class="col-xs-12 col-sm-4 col-md-3">
                    @php
                    $elementId = ($display == 'albums') ? "album-{$id}" : "foto-{$id}";
                    $elementSrc = $photo['src'] ?? $photo['cover'];

                    if ($display == 'albums') {
                        $elementUrl = "/fotos/album/{$elementId}";
                    } else if ($display == 'album') {
                        $elementUrl = "/fotos/album/{$albumId}/{$elementId}";
                    } else {
                        $elementUrl = "/fotos/{$elementId}";
                    }
                    @endphp
                    <a href="{{ $elementUrl }}" class="photo" id="{{ $elementId }}">
                        <img src="{{ $elementSrc }}?w=300&h=250" alt="{{ $photo['description'] or 'Sem imgagem' }}" class="photo__content">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <nav aria-label="Page navigation" class="photos__navigation col-xs-12">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i < $qty; $i++)
                        <li>
                            <a href="/fotos/{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
