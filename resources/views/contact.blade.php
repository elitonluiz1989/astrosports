@extends('layout.app')

@section('title', 'Contato')

@section('content')
    <div class="contact page">
        <header class="row">
            <h2 class="page__title contact__title">Contato</h2>
        </header>

        <div class="row">
            <h2 class="contact__section-title">Fale conosco</h2>

            <ul class="contacts list col-12">
                <li class="list__item">
                    <div class="contacts__subtitle">Telefones</div>
                </li>

                @foreach ($telephones as $telephone)
                    <li class="list__item contacts__item">{{ $telephone }}</li>
                @endforeach

                <li class="list__item">
                    <div class="contacts__subtitle">E-mails</div>
                </li>

                @foreach ($emails as $email)
                    <li class="list__item contacts__item">{{ $email }}</li>
                @endforeach
            </ul>
        </div>

        <contact-email subject-selected="{{ $subject}}"></contact-email>

        <contact-address :address="'{{ $localization['address'] }}'" :title="'{{ $localization['title'] }}'"></contact-address>
    </div>
@endsection
