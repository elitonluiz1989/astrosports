<div class="schedules__container">
    <div class="schedules__row d-none d-sm-flex">
        <div class="schedules__wrapper schedules__wrapper--left">
            <div class="schedules__bar schedules__bar--empty">&nbsp;</div>
        </div>

        <div class="schedules__wrapper schedules__wrapper--right">
            @foreach ($days as $day)
                <div class="schedules__bar schedules__bar--filled">{{ $day }}</div>
            @endforeach
        </div>
    </div>

    @foreach ($data as $target => $contents)
        <div class="schedules__row">
            <div class="schedules__target-text schedules__wrapper schedules__wrapper--left">{{ $target }}</div>

            <div class="schedules__wrapper schedules__wrapper--right">
                @foreach ($contents as $contentDay => $content)
                    @if (null != $content)
                        <div class="schedules__item">
                            <div class="schedules__item-content schedules__item-content--xs-up">{{ $days[$contentDay] }}</div>

                            @foreach ($content as $finalContentKey => $finalContent)
                                <div class="schedules__item-content schedules__item-content--up">
                                    <div class="w-100">{{ $finalContentKey }}</div>
                                </div>
                                @php $num = count($finalContent); @endphp

                                @for ($i=0; $i < $num; $i++)
                                    <div class="schedules__item-content schedules__item-content--down">
                                        <div class="w-100">{{ $finalContent[$i][$wantedField] }}</div>
                                    </div>
                                @endfor
                            @endforeach
                        </div>
                    @else
                        <div class="schedules__item d-none d-sm-flex">
                            <div class="schedules__item-content">{{ $days[$contentDay] }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>
