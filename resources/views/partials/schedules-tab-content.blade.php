@php
    $rowsClass = 'schedules__row';
    $colsWrapper1Class = 'col-sm-2 col-lg-1';
    $colsWrapper2Class = 'col-reset col-sm-10 col-lg-11';
@endphp

<div class="schedules__conteiner">
    <div class="{{ $rowsClass }} hidden-xs">
        <div class="schedules__bar schedules__bar--empty {{ $colsWrapper1Class }}"></div>

        <div class="{{ $colsWrapper2Class }}">
            @foreach ($days as $day)
                <div class="schedules__bar schedules__bar--content">{{ $day }}</div>
            @endforeach
        </div>
    </div>
    @foreach ($data as $target => $contents)
        <div class="{{ $rowsClass }}">
            <div class="schedules__wrapper schedules__target-text col-xs-12 {{ $colsWrapper1Class }}">
                <div class="schedules__item-text">{{ $target }}</div>
            </div>

            <div class="schedules__wrapper col-xs-12 {{ $colsWrapper2Class }}">
                @foreach ($contents as $contentDay => $content)

                    @if (null != $content)
                        <div class="schedules__item">
                            <div class="schedules__item-content schedules__item-content--xs-up visible-xs">
                                <div class="schedules__item-text">{{ $days[$contentDay] }}</div>
                            </div>

                            @foreach ($content as $finalContentKey => $finalContent)
                                <div class="schedules__item-content schedules__item-content--up">
                                    <div class="schedules__item-text">{{ $finalContentKey }}</div>
                                </div>
                                @php $num = count($finalContent); @endphp

                                @for ($i=0; $i < $num; $i++)
                                    <div class="schedules__item-content schedules__item-content--down">
                                        <div class="schedules__item-text">{{ $finalContent[$i][$wantedField] }}</div>
                                    </div>
                                @endfor
                            @endforeach
                        </div>
                    @else
                        <div class="schedules__item hidden-xs">
                            <div class="schedules__item-content schedules__item--empty">
                                <div class="schedules__item-text">{{ $days[$contentDay] }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>
