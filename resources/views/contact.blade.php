@extends('template.app')

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

    <div class="row localization">
        <h2 class="contact__section-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Localização</h2>
        <p class="col-xs-12 col-lg-10 col-lg-offset-1">{{ $localization['title'] }}</p>
        <p class="col-xs-12 col-lg-10 col-lg-offset-1">{{ $localization['address'] }}</p>
        <div class="col-xs-12 col-lg-10 col-lg-offset-1">
            <iframe class="localization__map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.699355279317!2d-54.66514355072046!3d-20.43644963132883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9486e712a2d9accd%3A0x27c5be65d936e49d!2sR.+Pte.+Preta%2C+Campo+Grande+-+MS!5e0!3m2!1spt-BR!2sbr!4v1492027319770" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endsection
