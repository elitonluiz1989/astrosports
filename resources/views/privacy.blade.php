@extends('layout.app')

@section('title', 'Termos de Uso e Privacidade')

@section('content')
    <div class="privacy page">
        <header class="row justify-content-center">
            <h2 class="privacy__title privacy__title--color privacy__item">Termos de Uso e Privacidade</h2>
        </header>

        <div id="videos" class="row justify-content-center">
            @foreach ($privacy as $item)
                <div class="privacy__item">
                    <h4 class="privacy__title--color">{{ $item['section'] }}</h4>
                        @foreach ($item['content'] as $content)
                            @if (isset($content['section']))
                                <h5 class="privacy__title--color">{{ $content['section'] }}</h5>
                                @foreach ($content['content'] as $subContent)
                                    <p class="privacy__content">{{ $subContent }}</p>
                                @endforeach
                            @else
                                <p class="privacy__content">{{ $content }}</p>
                            @endif
                        @endforeach
                </div>
            @endforeach
        </div>

    </div>
@endsection
