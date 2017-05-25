@extends('template.app')

@section('title', 'Contato')

@section('content')
    <div class="contact page">
        <div class="contact-wrapper">
            <h2 class="contact-title">Fale conosco</h2>
            <ul class="list">
                <li class="list-item">
                    <div class="contacts-subtitle">Telefones</div>
                </li>
                @foreach ($telephones as $telephone)
                    <li class="list-item contacts-item">{{ $telephone }}</li>
                @endforeach
                <li class="list-item">
                    <div class="contacts-subtitle">E-mails</div>
                </li>
                @foreach ($emails as $email)
                    <li class="list-item contacts-item">{{ $email }}</li>
                @endforeach
            </ul>
        </div>
        <div class="contact-wrapper">
            <h2 class="contact-title">Envie-nos uma mensagem</h2>
            <form id="send-email" class="send-email" action="/contato/enviar" >
                <div class="send-email-group">
                    <label class="control-label col-xs-12 col-sm-4 col-md-3" for="send-email-name">Nome</label>
                    <div class="col-xs-12 col-sm-6 col-md-7">
                        <input id="send-email-name" class="form-control input-lg" type="text" name="send-email-name">
                    </div>
                </div>
                <div class="send-email-group">
                    <label class="control-label col-xs-12 col-sm-4 col-md-3" for="send-email-email">E-mail</label>
                    <div class="col-xs-12 col-sm-6 col-md-7">
                        <input id="send-email-email" class="form-control input-lg" type="text" name="send-email-email">
                    </div>
                </div>
                <div class="send-email-group">
                    <textarea id="send-email-text" class="send-email-text form-control" name="send-email-text"></textarea>
                </div>
                <input type="submit" id="send-email-submit" class="btn btn-default" value="Enviar">
            </form>
        </div>
        <div class="contact-wrapper localization">
            <h2 class="contact-title">Localização</h2>
            <p class="localization-title">{{ $localization['title'] }}</p>
            <p class="localization-address">{{ $localization['address'] }}</p>
            <iframe class="localization-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.699355279317!2d-54.66514355072046!3d-20.43644963132883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9486e712a2d9accd%3A0x27c5be65d936e49d!2sR.+Pte.+Preta%2C+Campo+Grande+-+MS!5e0!3m2!1spt-BR!2sbr!4v1492027319770" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endsection
