@extends('layout.app')

@section('page', 'photos')
@section('content')
    <div class="photos page page--full">
        <header class="row">
            <h2 class="page__title photos__title">Fotos</h2>

            <ul class="photos-tabs nav nav-tabs col-12">
                @foreach ($navItems as $item => $content)
                    @php $class = ($display == $item) ? 'nav-link active' : 'nav-link'; @endphp

                    <li class="nav-item">
                        <a class="{{ $class }}" href="{{ $content['url'] }}">{{ $content['text'] }}</a>
                    </li>
                @endforeach
            </ul>
        </header>
        {{ dd($records['records']->items) }}
        @if (count($records['records']) > 0)
            @if (isset($albumName) && null != $albumName)
                @include('photos.album-title', ['name' => $albumName])
            @endif

            @include('photos.item', $records)

            @if (property_exists($records['records'], "paging"))
                <nav aria-label="Page navigation" class="row row justify-content-center pagination--bottom">
                    <ul class="pagination">
                        @if (!$records['records']->paging->IsFirstPage())
                            <li class="page-item">
                                <a href="{{ $records['records']->paging->GetPrevUrl() }}" class="page-link">Anterior</a>
                            </li>
                        @endif

                        @if (!$records['records']->paging->IsLastPage())
                            <li class="page-item">
                                <a href="{{ $records['records']->paging->GetNextUrl() }}" class="page-link">Próxima</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @else
            {!! $emptyMessage !!}
        @endif
    </div>
@endsection
