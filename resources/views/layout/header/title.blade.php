<div class="row d-none d-sm-flex justify-content-end">
    <div class="header__logo col-sm-2">
        <img src="../images/logo.png" alt="Astro Sports logo" class="img-fluid">
    </div>

    <div id="header-title-default" class="header__title col-sm-10">
        <h1 class="header__title-text">Escola de Futebol Astro Sports</h1>
        <h2 class="header__title-subtitle">#Descobrindo valores</h2>
    </div>

    <div class="col-sm-10">
        @include('layout.contact-list', $template->social())
    </div>
</div>