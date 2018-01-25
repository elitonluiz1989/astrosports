<div class="sidebar__schedule sidebar-left__wrapper">
    <h2 class="sidebar__schedule-title sidebar__title">Horários</h2>

    <ul class="sidebar__schedule-nav tabs nav nav-tabs">
        @foreach ($weekDays as $day => $dayText)
            @php
                $class = ($day == $currentDay) ? 'tabs-item active' : 'tabs-item';
            @endphp
            <li role="presentation" class="{{ $class }}">
                <a href="/#{{ $day }}" data-toggle="tab">{{ $dayText }}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
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
                            <div class="sidebar__schedule-wrapper row">
                                <div class="sidebar__schedule-hour col-sm-3">
                                    <div class="sidebar__schedule-hour-content">{{ $hour }}</div>
                                </div>

                                <div class="col-reset col-sm-8 col-sm-offset-1">
                                    @foreach ($content as $pole => $categories)
                                        <div class="col-sm-12 col-reset">
                                            <div class="sidebar__schedule-pole">{{ $pole }}</div>

                                            @foreach ($categories as $category)
                                                <div class="sidebar__schedule-category">{{ $category['category'] }}</div>
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
                            <div class="sidebar__schedule-item">
                                <div class="sidebar__schedule-empty">Sem horários<br>...</div>
                            </div>
                        </div>
                    @endcomponent
                @endif
            @endforeach
        </div>
</div>
