
<div class="assessments sidebar--left__wrapper">
    <header class="row">
        <h2 class="assessments__title sibebar__title">Avaliações</h2>
    </header>

    <form id="form-imc" class="imc form-horizontal" action="/avaliacoes/imc" method="post">
        <legend class="imc__title">IMC</legend>

        <div class="imc_info imc__wrapper">
            <button id="imc-show-info" class="imc__info-btn">O que é o IMC? Clique para saber mais.</button>
            <div class="imc__info-content">
                <p class="imc__text">IMC é a sigla para Índice de Massa Corporal, que é uma medida utilizada para medir a obesidade.</p>
                <p class="imc__text">O cálculo é feito dividindo o peso (em quilogramas) pela altura (em metros) ao quadrado.</p>
                <p class="imc__text">IMC pode apresentar alterações, dependendo de fatores como a prática de exercícios físicos.</p>
            </div>
        </div>

        <div class=" imc__wrapper">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="imc__weight">Peso</label>
                <div class="col-sm-9">
                    <input id="imc__weight" class="form-control input-lg" name="imc__weight" type="text" placeholder="0.000">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="imc__height">Altura</label>
                <div class="col-sm-9">
                    <input id="imc__height"  class="form-control input-lg" name="imc__height" type="text"placeholder="0.00">
                </div>
            </div>
        </div>

        <input id="imc__submit" class="imc__submit" type="submit" value="Calcular">
    </form>
</div>
