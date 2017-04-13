@php
$days = [
    'mon' => "SEG",
    'tue' => "TER",
    'Wed' => "QUA",
    'thu' => "QUI",
    'fri' => "SEX",
    'sat' => "SÁB"
]
@endphp

@inject('schedulesRepository', 'App\Repositories\SchedulesRepository')
@inject('videosRepository', 'App\Repositories\VideosRepository')

<section class="sidebar hidden-xs col-sm-4 col-md-3">
    <div class="sidebar__schedule sidebar__wrap">
        <header>
            <h1 class="schedule__title sidebar__title">Horários</h1>
            <ul class="schedule__nav nav nav-justified">
                @foreach ($days as $day => $title)
                    <li>
                        <a class="schedule__nav-content" href="#schedule-{{ $day }}">{{ $title }}</a>
                    </li>
                @endforeach
            </ul>
        </header>
        <table class="schedule table">
            @php $schedules = $schedulesRepository->all(); @endphp
            @if (count($schedules) > 0)
                @foreach ($schedules as $hour=>$poles)
                    @php $numPoles = count($poles); @endphp
                    <tr>
                        @if ($numPoles == 1)
                            <td class="schedule__item schedule__item--bordered schedule__hour">
                            @else
                                <td class="schedule__item schedule__item--bordered schedule__hour" rowspan="{{ $numPoles }}">
                                @endif
                                <div class="schedule__hour-content">{{ $hour }}</div>
                            </td>
                            @php $c = 1; @endphp
                            @foreach ($poles as $pole => $categories)
                                @php $scheduleItemClass = "schedule__item schedule__category"; @endphp

                                @if ($numPoles == 1)
                                    @php $scheduleItemClass .= " schedule__item--bordered"; @endphp
                                @elseif ($c == $numPoles)
                                    @php $scheduleItemClass .= " schedule__item--bordered"; @endphp
                                @endif

                                @if ($c == 1)
                                    @php $scheduleItemClass .= " schedule__item--first"; @endphp
                                @else
                                </tr>
                                <tr>
                                @endif
                                <td class="{{ $scheduleItemClass }}">
                                    <div class="schedule__category-pole">{{ $pole }}</div>
                                    @foreach ($categories as  $category)
                                        <div class="schedule__category-name">{{ $category }}</div>
                                    @endforeach
                                </td>
                                @php $c++; @endphp
                            @endforeach
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="schedule__item schedule__item--bordered">
                            <div class="schedule__empty">Sem horários<br>...</div>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="sidebar__videos sidebar__wrap">
            <header>
                <h1 class="sidebar__videos-title sidebar__title">Últimos Vídeos</h1>
            </header>
            <ul class="list">
                @php $videos = $videosRepository->all(); @endphp
                @if (count($videos) > 0)
                    @foreach ($videos as $video)
                        <li class="list__item">
                            <div class="sidebar__videos-item">
                                <iframe class="sidebar__videos-video" src="{{ $video }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </li>
                    @endforeach
                    <li class="list__item">
                        <a class="sidebar__videos-more btn btn-default" href="/videos">Mais vídeos</a>
                    </li>
                @else
                    <li class="list__item">
                        <div class="sidebar__videos-novideos">Sem vídeos<br>...</div>
                    </li>
                @endif
            </ul>
        </div>
    </section>
