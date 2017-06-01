@extends('template.app')

@section('title', 'Contato')

@section('content')
    <div class="contact page">
        <header class="row">
            <h2 class="page-title contact-page-title">Contato</h2>
        </header>
        <div class="row">
            <h2 class="contact-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Fale conosco</h2>
            <ul class="list col-xs-12">
                <li class="list-item">
                    <div class="contacts-subtitle col-xs-8 col-sm-5 col-md-4 col-lg-3">Telefones</div>
                </li>
                @foreach ($telephones as $telephone)
                    <li class="list-item contacts-item">
                        <div class="col-xs-11">{{ $telephone }}</div>
                    </li>
                @endforeach
                <li class="list-item">
                    <div class="contacts-subtitle col-xs-8 col-sm-5 col-md-4 col-lg-3">E-mails</div>
                </li>
                @foreach ($emails as $email)
                    <li class="list-item contacts-item">
                        <div class="col-xs-11">{{ $email }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="row">
            <h2 class="contact-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Envie-nos uma mensagem</h2>
            <form id="send-email" class="send-email col-xs-12 col-lg-9 col-lg-offset-1" action="/contato/enviar" >
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 col-md-3 col-lg-2" for="send-email-name">Nome</label>
                    <div class="input-group col-xs-12 col-sm-8 col-md-7">
                        <input id="send-email-name" class="form-control input-lg" type="text" name="send-email-name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 col-md-3 col-lg-2" for="send-email-email">E-mail</label>
                    <div class="input-group col-xs-12 col-sm-10 col-md-9 col-lg-9">
                        <input id="send-email-email" class="form-control input-lg" type="text" name="send-email-email">
                    </div>
                </div>
                <div class="form-group">
                    <textarea id="send-email-text" class="send-email-text form-control col-xs-12" name="send-email-text"></textarea>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="submit" id="send-email-submit" class="send-email-submit btn btn-default" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
        <div class="row localization">
            <h2 class="contact-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Localização</h2>
            <p class="col-xs-12 col-lg-10 col-lg-offset-1">{{ $localization['title'] }}</p>
            <p class="col-xs-12 col-lg-10 col-lg-offset-1">{{ $localization['address'] }}</p>
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <iframe class="localization-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.699355279317!2d-54.66514355072046!3d-20.43644963132883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9486e712a2d9accd%3A0x27c5be65d936e49d!2sR.+Pte.+Preta%2C+Campo+Grande+-+MS!5e0!3m2!1spt-BR!2sbr!4v1492027319770" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
