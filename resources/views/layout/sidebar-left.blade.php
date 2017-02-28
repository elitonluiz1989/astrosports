@php
    $schedules = [
        "01:00" => [ "Categoria 001" ],
        "02:00" => [ "Categoria 002", "Categoria 004" ],
        "03:00" => [ "Categoria 003" ],
        "04:00" => [ "Categoria 004" ],
        "05:00" => [ "Categoria 001", "Categoria 003","Categoria 005" ]
    ]
@endphp
<section class="sidebar col-sm-3">
    <div class="sidebar-schedule sidebar-wrap list">
        <header class="sidebar-schedule-header sidebar-list-item">
            <h1 class="sidebar-schedule-title">Horários</h1>
            <ul class="sidebar-schedule-nav">
                <a href="#schedule-mon">SEG</a>
                <a href="#schedule-tue">TER</a>
                <a href="#schedule-wed">QUA</a>
                <a href="#schedule-thu">QUI</a>
                <a href="#schedule-fri">SEX</a>
                <a href="#schedule-sat">SÁB</a>
            </ul>
        </header>
        <ul class="list">
            @foreach ($schedules as $hour => $categories)
            <li class="sidebar-list-item">
                <div class="shedule-hour">{{ $hour }}</div>
                @foreach ($categories as $category)
                <div class="schedule-category">{{ $category }}</div>
                @endforeach
            </li>
            @endforeach
        </ul>
    </div>
</section>
