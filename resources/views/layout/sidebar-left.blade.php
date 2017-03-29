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
            @php $c = 1; @endphp
            @foreach ($poles as $pole => $categories)
              @php $scheduleItemClass = "schedule-item schedule-category"; @endphp

              @if ($numPoles == 1)
                @php $scheduleItemClass .= " schedule-item--bordered"; @endphp
              @elseif ($c == $numPoles)
                @php $scheduleItemClass .= " schedule-item--bordered"; @endphp
              @endif

              @if ($c == 1)
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
  <div class="sidebar-videos sidebar-wrap">
    <header>
      <h1 class="sidebar-videos--title sidebar-title">Últimos Vídeos</h1>
    </header>
    <ul class="list">
      @if (count($videos) > 0)
        @foreach ($videos as $video)
          <li class="list-item">
            <div class="sidebar-videos--item">
              <iframe class="sidebar-videos--video" src="{{ $video }}" frameborder="0" allowfullscreen></iframe>
            </div>
          </li>
        @endforeach
      @else
        <li class="list-item">
          <div class="sidebar-videos--item">
            <span class="sidebar-videos--noitem">Sem vídeo</span>
          </div>
        </li>
      @endif
    </ul>
    <a class="sidebar-videos--more btn btn-default" href="/videos">Mais vídeos</a>
  </div>
</section>
