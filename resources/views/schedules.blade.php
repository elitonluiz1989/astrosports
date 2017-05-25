@extends('template.app')

@section('title', 'Horários')

@php
// Var treatment

// -- Display --
$displayByItem = "schedules-display-item";

$schedulesClass = $displayByItem;
$polesClass = $displayByItem;
$categoriesClass = $displayByItem;

if ($display == 'poles')  {
    $polesClass .= " active";
} else if ($display == 'categories') {
    $categoriesClass .= " active";
} else {
    $schedulesClass .= " active";
}
// -- Shedule content --
$days = [ 'seg' => 'SEG', 'ter' => 'TER', 'qua' => 'QUA', 'qui' => 'QUI', 'sex' => 'SEX', 'sab' => 'SÁB' ];
$categories = [
    1 => '05 a 06 anos',
    '07 a 09 anos',
    '10 a 12 anos',
    '13 a 15 anos',
    '16 a 18 anos',
    '19 a 21 anos'
];
$poles = [
    1 => 'Coophatrabalho',
    'Petrópolis',
    'Serradinho'
];
@endphp

@section('content')
    <div class="schedules page">
        <div class="row">
            <ul class="schedules-display-by nav nav-tabs">
                <li role="presentation" class="{{ $schedulesClass }}">
                    <a href="/horarios">Horários</a>
                </li>
                <li role="presentation" class="{{ $polesClass }}">
                    <a href="/horarios/polos">Polos</a>
                </li>
                <li role="presentation" class="{{ $categoriesClass }}">
                    <a href="/horarios/categorias">Categorias</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <table class="schedules-listing">
                <thead>
                    <tr>
                        <th class="schedules-title"></th>
                        @foreach ($days as $day)
                            <th class="schedules-item schedules-title">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $key => $schedules)
                        @php
                            if ($display == "poles") {
                                $target = $poles[$key] ?? '[Polo]';
                                $replacements = $categories;
                            } else {
                                $target = $categories[$key] ?? '[Categoria]';
                                $replacements = $poles;
                            }
                        @endphp
                        <tr>
                            <td class="schedules-title">{{ $target }}</td>
                            @foreach ($schedules as $day => $schedule)
                                @if (null == $schedule)
                                    <td class="schedules-item">
                                        <div class="schedules-item-content">{{ ucfirst(str_replace('sab', 'sáb', $day)) }}</div>
                                    </td>
                                @else
                                    <td class="schedules-item">
                                        @foreach ($schedule as $value)
                                            @php
                                                list($value1, $value2) = array_values($value);
                                            @endphp
                                            <div class="schedules-item-content schedules-item-content--xs-up visible-xs">{{ $days[$day] }}</div>
                                            <div class="schedules-item-content schedules-item-content--up">{{ $replacements[$value1] }}</div>
                                            <div class="schedules-item-content">{{ $value2 }}</div>
                                        @endforeach
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
