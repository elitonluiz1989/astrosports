@php
    if (isset($listOrientation)) {
        $listItemOrientation = \str_replace(['right', 'left'], [' contact-list__item--horizontal', ' contact-list__item--vertical'], $listOrientation);

        $listOrientation = \str_replace(['right', 'left'], [' float-right', ' contact-list--left'], $listOrientation);
    } else {
        $listOrientation = '';
        $listItemOrientation = '';
    }

    $showSocialTitle = $showSocialTitle ?? false;
@endphp

<ul class="contact-list{{ $listOrientation }}">
    @foreach ($social as $icon => $url)
        <li class="contact-list__item{{ $listItemOrientation }}">
            <a href="{{ $url }}" class="contact-list__content" {{ ($icon != 'whatsapp')? 'target="_blank"' : null }}>
                @php $faIcon = \str_replace('youtube', 'youtube-play', $icon); @endphp
                <div class="contact-list__icon contact-list__icon--{{ $icon }}">
                    <i class="fa fa-{{ $faIcon }}"></i>
                </div>

                @if ($showSocialTitle)
                    @php $title = \ucfirst(\str_replace('-', ' ', $icon)); @endphp
                    <span class="contact-list__title">{{ $title }}</span>
                @endif
            </a>
        </li>
    @endforeach
</ul>
