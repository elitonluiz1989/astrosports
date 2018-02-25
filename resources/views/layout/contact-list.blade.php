@php
    $listOrientation = $listOrientation ?? 'center';

    $listOrientation = 'text-' . $listOrientation;
@endphp

<nav class="contact-list {{ $listOrientation }}">
    @foreach ($social as $icon => $url)
        <div class="contact-list__item">
            <a href="{{ $url }}" class="contact-list__content" {{ ($icon != 'whatsapp') ? 'target="_blank"' : null }}>
                @php $faIcon = \str_replace('youtube', 'youtube-play', $icon); @endphp
                <div class="contact-list__icon contact-list__icon--{{ $icon }}">
                    <i class="fa fa-{{ $faIcon }}"></i>
                </div>
            </a>
        </div>
    @endforeach
</nav>
