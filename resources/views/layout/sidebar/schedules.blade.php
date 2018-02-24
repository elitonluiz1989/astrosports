<div class="sidebar__schedule sidebar__wrapper">
    <h2 class="sidebar__schedule-title sidebar__title">Horários</h2>

    @php
        $navSettings = [
            'navId' => 'sidebar-schedules-days',
            'navItems' => $weekDays,
            'navItemPrefix' => 'schedule',
            'customClass' => 'sidebar__schedule-nav',
            'target' => $currentDay
        ];
    @endphp

    @include('partials.tabs.nav', $navSettings)

    <div class="tab-content" id="sidebar-schedule-content">
            @foreach ($schedules as $day => $schedule)
                @component('partials.tabs.content')
                    @slot('tabContentId', 'schedule-' . $day)

                    @slot('customClass', 'container')

                    @slot('labelledBy', 'schedule-' . $day)

                    @if ($currentDay == $day)
                        @slot('isActive', true)
                    @endif

                    @if (null != $schedule)
                        @foreach ($schedule as $hour => $content)
                            <div class="sidebar__schedule-wrapper row">
                                <div class="sidebar__schedule-hour col-sm-3">
                                    <div class="sidebar__schedule-hour-content">{{ $hour }}</div>
                                </div>

                                <div class="sidebar__schedule-content col-sm-9">
                                    @foreach ($content as $pole => $categories)
                                        <div class="w-100">
                                            <div class="sidebar__schedule-pole">{{ $pole }}</div>

                                            @foreach ($categories as $category)
                                                <div class="sidebar__schedule-category">{{ $category['category'] }}</div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="sidebar__schedule-empty">{!! $scheduleEmptyMessage !!}</div>
                    @endif
                @endcomponent
            @endforeach
        </div>
</div>
