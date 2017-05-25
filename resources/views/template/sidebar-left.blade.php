@php
$days = [
    'mon' => "SEG",
    'tue' => "TER",
    'Wed' => "QUA",
    'thu' => "QUI",
    'fri' => "SEX",
    'sat' => "SÁB"
];
$categoriesList = [
    1 => '05 a 06 anos',
    '07 a 09 anos',
    '10 a 12 anos',
    '13 a 15 anos',
    '16 a 18 anos',
    '19 a 21 anos'
];
$polesList = [
    1 => 'Coophatrabalho',
    'Petrópolis',
    'Serradinho'
];
@endphp

@inject('schedulesRepository', 'App\Repositories\SchedulesRepository')
@inject('videosRepository', 'App\Repositories\VideosRepository')

<section class="sidebar hidden-xs col-sm-4 col-md-3">
    <div class="sidebar-schedule sidebar-wrap">
        <header>
            <h1 class="schedule-title sidebar-title">Horários</h1>
            <ul class="schedule-nav nav nav-justified">
                @foreach ($days as $day => $title)
                    <li>
                        <a class="schedule-nav-content" href="#schedule-{{ $day }}">{{ $title }}</a>
                    </li>
                @endforeach
            </ul>
        </header>
        <table class="schedule table">
            @php $schedules = $schedulesRepository->get('schedules'); $day = 'seg';@endphp
            @if (count($schedules) > 0)
                @foreach ($schedules as $hour=>$poles)
                    @if (count($poles[$day]) > 0)
                        @php $numPoles = count($poles[$day]); @endphp
                        <tr>
                            @php $rowspan = ($numPoles == 1) ? '' : ' rowspan="' . $numPoles . '"'; @endphp

                            <td class="schedule-item schedule-item--bordered schedule-hour"{{ $rowspan }}>
                                <div class="schedule-hour-content">{{ $hour }}</div>
                            </td>

                            @for ($i = 0; $i < $numPoles; $i++)
                                @php
                                $scheduleItemClass = "schedule-item schedule-category";

                                if ($numPoles == 1) {
                                    $scheduleItemClass .= " schedule-item--bordered";
                                } else if ($i == ($numPoles - 1)) {
                                    $scheduleItemClass .= " schedule-item--bordered";
                                }

                                if ($i == 0) {
                                    $scheduleItemClass .= " schedule-item--first";
                                } else {
                                    echo '</tr><tr>';
                                }
                                @endphp

                                <td class="{{ $scheduleItemClass }}">
                                    <div class="schedule-category-pole">{{ $polesList[$poles[$day][$i]['pole']] }}</div>
                                    @foreach ($poles[$day][$i]['categories'] as  $category)
                                        <div class="schedule-category-name">{{ $categoriesList[$category] }}</div>
                                    @endforeach
                                </td>
                            @endfor
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td class="schedule-item schedule-item--bordered">
                        <div class="schedule-empty">Sem horários<br>...</div>
                    </td>
                </tr>
            @endif
            </table>
        </div>
        <div class="sidebar-videos sidebar-wrap">
            <header>
                <h1 class="sidebar-videos-title sidebar-title">Últimos Vídeos</h1>
            </header>
            <ul class="list">
                @php $videos = $videosRepository->all(); @endphp
                @if (count($videos) > 0)
                    @foreach ($videos as $video)
                        <li class="list-item">
                            <div class="sidebar-videos-item">
                                <iframe class="sidebar-videos-video" src="{{ $video }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </li>
                    @endforeach
                    <li class="list-item">
                        <a class="sidebar-videos-more btn btn-default" href="/videos">Mais vídeos</a>
                    </li>
                @else
                    <li class="list-item">
                        <div class="sidebar-videos-novideos">Sem vídeos<br>...</div>
                    </li>
                @endif
            </ul>
        </div>
    </section>
