@extends('layout.app')

@section('title', 'Contato')

@section('content')
    <div class="contact">
        <div class="contact__wrapper">
            <h2 class="contact__title">Fale conosco</h2>
            <ul class="list">
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
        <div class="contact__wrapper">
            <h2 class="contact__title">Envie-nos uma mensagem</h2>
            <form id="send-email" class="send-email" action="/contato/enviar" >
                <div class="send-email__group">
                    <label class="control-label col-xs-5 col-sm-4 col-md-3" for="send-email__name">Nome</label>
                    <div class="col-xs-7 col-sm-6 col-md-7">
                        <input id="send-email__name" class="form-control input-lg" type="text" name="send-email__name">
                    </div>
                </div>
                <div class="send-email__group">
                    <label class="control-label col-xs-5 col-sm-4 col-md-3" for="send-email__email">E-mail</label>
                    <div class="col-xs-7 col-sm-6 col-md-7">
                        <input id="send-email__email" class="form-control input-lg" type="text" name="send-email__email">
                    </div>
                </div>
                <div class="send-email__group">
                    <textarea id="send-email__text" class="send-email__text form-control" name="send-email__text"></textarea>
                </div>
                <input type="submit" id="send-email__submit" class="btn btn-default" value="Enviar">
            </form>
        </div>
        <div class="contact__wrapper localization">
            <h2 class="contact__title">Localização</h2>
            <p class="localization__title">{{ $localization['title'] }}</p>
            <p class="localization__address">{{ $localization['address'] }}</p>
            <iframe class="localization__map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.699355279317!2d-54.66514355072046!3d-20.43644963132883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9486e712a2d9accd%3A0x27c5be65d936e49d!2sR.+Pte.+Preta%2C+Campo+Grande+-+MS!5e0!3m2!1spt-BR!2sbr!4v1492027319770" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endsection
