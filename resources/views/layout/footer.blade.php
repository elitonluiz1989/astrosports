<footer class="footer container-fluid">
    <ul class="footer-contact row justify-content-center">
        <li class="footer-item col-12 col-sm-5 col-lg-4 col-xl-3">
            <div class="footer-content">
                <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
            </div>

            @foreach ($telephones as $telephone)
                <div class="footer-content">{{ $telephone }}</div>
            @endforeach
        </li>

        <li class="footer-item col-12 col-sm-2 col-lg-1">
            <div class="footer-content footer-content--separator d-sm-none">...</div>
            <div class="footer-content footer-content--separator d-none d-sm-block">.</div>
        </li>

        <li class="footer-item col-12 col-sm-5 col-lg-4 col-xl-3">
            <div class="footer-content">
                <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
            </div>

            @foreach ($emails as $email)
                <div class="footer-content">{{ $email }}</div>
            @endforeach
        </li>

        <li class="footer-item col-12 d-sm-none">
            <div class="footer-content footer-content--separator">...</div>
        </li>

        <li class="footer-item col-12">
            @include('layout.contact-list', $social)
        </li>

        <li class="footer-item col-12">
            <div class="footer-content footer-content--separator">...</div>
        </li>

        <li class="footer-item col-12">
            <div class="footer-content"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>{{ $localization['address'] }}</div>
        </li>
    </ul>
</footer>