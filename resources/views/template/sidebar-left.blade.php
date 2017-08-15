@inject('sidebar', 'App\Http\Controllers\SidebarController')

@php
    $currentDay = strtolower(date('D'));

    $days = [
        'sun' => 'DOM',
        'mon' => 'SEG',
        'tue' => 'TER',
        'wed' => 'QUA',
        'thu' => 'QUI',
        'fri' => 'SEX',
        'sat' => 'SÁB'
    ];

$schedules = $sidebar->schedules();

$videos = $sidebar->videos();
@endphp

<div class="sidebar hidden-xs col-sm-4 col-md-3">
    <div class="sidebar__schedule sidebar__wrapper">
        <header>
            <h1 class="schedule__title sidebar__title">Horários</h1>
        </header>
        <ul class="schedule__nav tabs nav nav-tabs">
            @foreach ($days as $day => $dayText)
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

    <!-- Videos -->
    @php $showVideos = $showSidebarVideos ?? true; @endphp
    @if ($showVideos)
        <div class="sidebar__videos sidebar__wrapper">
            <header>
                <h1 class="sidebar__videos-title sidebar__title">Últimos Vídeos</h1>
            </header>
            <ul class="list">
                @if (count($videos) > 0)
                    @foreach ($videos as $video)
                        <li class="list-item">
                            <div class="sidebar__videos-item">
                                <a href="{{ $video['url'] }}" class="sidebar__videos-content" target="_blank">
                                    <img src="{{ $video['img'] }}" alt="" class="img">
                                </a>
                            </div>
                        </li>
                    @endforeach
                    <li class="list-item">
                        <a class="sidebar__videos--more btn btn-default" href="/videos">Mais vídeos</a>
                    </li>
                @else
                    <li class="list-item">
                        <div class="sidebar__videos--no-videos">Sem vídeos<br>...</div>
                    </li>
                @endif
            </ul>
        </div>
    @endif
</div>
