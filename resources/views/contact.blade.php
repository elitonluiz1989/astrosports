@extends('layout.app')

@section('title', 'Contato')

@section('page', 'contact')

@section('content')
    <header class="row">
        <h2 class="page__title contact__title">Contato</h2>
    </header>

    <div class="row">
        <h2 class="contact__section-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Fale conosco</h2>

        <ul class="list col-xs-12">
            <li class="list__item">
                <div class="contacts__subtitle col-xs-8 col-sm-5 col-md-4 col-lg-3">Telefones</div>
            </li>

            @foreach ($telephones as $telephone)
                <li class="list__item contacts__item">
                    <div class="col-xs-11">{{ $telephone }}</div>
                </li>
            @endforeach

            <li class="list__item">
                <div class="contacts__subtitle col-xs-8 col-sm-5 col-md-4 col-lg-3">E-mails</div>
            </li>

            @foreach ($emails as $email)
                <li class="list__item contacts__item">
                    <div class="col-xs-11">{{ $email }}</div>
                </li>
            @endforeach
        </ul>
    </div>

    <contact-email subject-selected="{{ $subjectSelected }}"></contact-email>

    <contact-address :address="'{{ $localization['address'] }}'" :title="'{{ $localization['title'] }}'"></contact-address>
@endsection
