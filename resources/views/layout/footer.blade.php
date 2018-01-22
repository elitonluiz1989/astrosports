<footer class="footer container-fluid">
    <section class="row">
        <ul class="footer-contact list-inline col-xs-12 col-md-12 col-lg-10 col-lg-offset-1">
            <li class="footer-item col-xs-12 col-sm-2 col-lg-2">
                @foreach ($telephones as $telephone)
                    <div class="footer-content">{{ $telephone }}</div>
                @endforeach
            </li>
            <li class="footer-item col-xs-12 col-sm-1">
                <div class="footer-content footer-content--separator visible-xs">...</div>
                <div class="footer-content footer-content--separator visible-sm-up hidden-xs">.</div>
            </li>
            <li class="footer-item col-xs-12 col-sm-2 col-lg-2">
                @foreach ($emails as $email)
                    <div class="footer-content">{{ $email }}</div>
                @endforeach
            </li>
            <li class="footer-item col-xs-12 col-sm-1">
                <div class="footer-content footer-content--separator visible-xs">...</div>
                <div class="footer-content footer-content--separator visible-sm-up hidden-xs">.</div>
            </li>
            <li class="footer-item col-xs-12 col-sm-2 col-lg-2">
                @include('layout.contact-list', $social)
            </li>
            <li class="footer-item col-xs-12 col-sm-1">
                <div class="footer-content footer-content--separator visible-xs">...</div>
                <div class="footer-content footer-content--separator visible-sm-up hidden-xs">.</div>
            </li>
            <li class="footer-item col-xs-12 col-sm-3 col-lg-3">
                <div class="footer-content">{{ $localization['address'] }}</div>
            </li>
        </ul>
    </section>
</footer>