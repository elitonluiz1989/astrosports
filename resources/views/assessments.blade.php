@extends('template.app')

@section('title', 'Avaliações')

@section('content')
    <div class="assessments page">
        <form id="form-imc" class="imc form-horizontal" action="/avaliacoes/imc" method="post">
            <legend class="imc-title">IMC</legend>
            <div class="col-xs-12 col-sm-12 col-md-6 imc-wrapper">
                <p class="imc-text">IMC é a sigla para Índice de Massa Corporal, que é uma medida utilizada para medir a obesidade.</p>
                <p class="imc-text">O cálculo é feito dividindo o peso (em quilogramas) pela altura (em metros) ao quadrado.</p>
                <p class="imc-text">IMC pode apresentar alterações, dependendo de fatores como a prática de exercícios físicos.</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 imc-wrapper imc-wrapper--bordered">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="imc-weight">Peso</label>
                    <div class="col-sm-9">
                        <input id="imc-weight" class="form-control input-lg" name="imc-weight" type="text" placeholder="0.000">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="imc-height">Altura</label>
                    <div class="col-sm-9">
                        <input id="imc-height"  class="form-control input-lg" name="imc-height" type="text"placeholder="0.00">
                    </div>
                </div>
            </div>
            <input id="imc-submit" class="imc-submit" type="submit" value="Calcular">
        </form>
    </div>
@endsection
