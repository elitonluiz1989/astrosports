@php
    $schedules = [
        "01:00" => [
            "Polo 001" => [ "Categoria 001" ]
        ],
        "02:00" => [
            "Polo 002" => [ "Categoria 002" ],
            "Polo 004" => [ "Categoria 004" ]
        ],
        "03:00" => [
            "Polo 003" => [
                "Categoria 003",
                "Categoria 004"
            ],
        ],
        "04:00" => [
            "Polo 004" => [ "Categoria 004" ]
        ],
        "05:00" => [
            "Polo 001" => [ "Categoria 001" ],
            "Polo 003" => [
                "Categoria 003",
                "Categoria 004"
            ],
            "Polo 005 " => [ "Categoria 005" ]
        ]
    ];

    $days = [
        'mon' => "SEG",
        'tue' => "TER",
        'Wed' => "QUA",
        'thu' => "QUI",
        'fri' => "SEX",
        'sat' => "SÁB"
    ]
@endphp
<section class="sidebar col-sm-4 col-md-3 hidden-xs">
    <div class="sidebar-schedule sidebar-wrap">
        <header class="schedule-header sidebar-list-item">
            <h1 class="schedule-title">Horários</h1>
            <ul class="schedule-nav nav nav-justified">
                @foreach ($days as $day => $title)
                  <li>
                      <a class="schedule-nav-content" href="#schedule-{{ $day }}">{{ $title }}</a>
                  </li>
                @endforeach
            </ul>
        </header>
        <table class="schedule table">
          @foreach ($schedules as $hour=>$poles)
            @php $numPoles = count($poles); @endphp
            <tr>
              @if ($numPoles == 1)
                <td class="schedule-item schedule-item--bordered schedule-hour">
              @else
                <td class="schedule-item schedule-item--bordered schedule-hour" rowspan="{{ $numPoles }}">
              @endif
                <div class="schedule-hour--content">{{ $hour }}</div>
              </td>
              @php $c = 0; @endphp
              @foreach ($poles as $pole => $categories)
                @php $scheduleItemClass = "schedule-item schedule-category"; @endphp

                @if ($numPoles == 1)
                  @php $scheduleItemClass .= " schedule-item--bordered"; @endphp
                @endif


                @if ($c == 0)
                  @php $scheduleItemClass .= " schedule-item--first"; @endphp
                @else
                  </tr>
                  <tr>
                @endif
                <td class="{{ $scheduleItemClass }}">
                  <div class="schedule-category--pole">{{ $pole }}</div>
                  @foreach ($categories as  $category)
                    <div class="schedule-category--name">{{ $category }}</div>
                  @endforeach
                </td>
                @php $c++; @endphp
              @endforeach
            </tr>
          @endforeach
        </table>
    </div>
</section>
