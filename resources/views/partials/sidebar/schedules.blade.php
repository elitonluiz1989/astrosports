<div class="sidebar--left__schedule sidebar--left__wrapper">
    <header>
        <h2 class="schedule__title">Horários</h2>
    </header>
    <ul class="schedule__nav tabs nav nav-tabs">
        @foreach ($weekDays as $day => $dayText)
            @php
                $class = ($day == $currentDay) ? 'tabs-item active' : 'tabs-item';
            @endphp
            <li role="presentation" class="{{ $class }}">
                <a href="/#{{ $day }}" data-toggle="tab">{{ $dayText }}</a>
            </li>
        @endforeach
    </ul>

    <div class="row">
        <div class="tab-content schedule">
            @foreach ($schedules as $day => $schedule)
                @if (null != $schedule)
                    @component('partials.tabs.item')
                        @slot('tabId')
                            {{ $day }}
                        @endslot

                        @if ($currentDay == $day)
                            @slot('tabActive')
                                in active
                            @endslot
                        @endif

                        @foreach ($schedule as $hour => $content)
                            <div class="schedule__wrapper row">
                                <div class="schedule__hour col-sm-3">
                                    <div class="schedule__hour-content">{{ $hour }}</div>
                                </div>

                                <div class="col-reset col-sm-8 col-sm-offset-1">
                                    @foreach ($content as $pole => $categories)
                                        <div class="col-sm-12 col-reset">
                                            <div class="schedule__pole">{{ $pole }}</div>

                                            @foreach ($categories as $category)
                                                <div class="schedule__category">{{ $category['category'] }}</div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endcomponent
                @else
                    @component('partials.tabs.item')
                        @slot('tabId')
                            {{ $day }}
                        @endslot

                        @if ($currentDay == $day)
                            @slot('tabActive')
                                in active
                            @endslot
                        @endif

                        <div class="row">
                            <div class="schedule__item">
                                <div class="schedule__empty">Sem horários<br>...</div>
                            </div>
                        </div>
                    @endcomponent
                @endif
            @endforeach
        </div>
    </div>
</div>
