@foreach ($data as $target => $contents)
    <div class="row">
        <div class="col-xs-12 col-lg-3">
            <div class="schedules-list-title col-xs-12">{{ $target }}</div>
        </div>
        <div class="col-xs-12 col-lg-9">
            @foreach ($days as $day => $dayName)
                @foreach ($contents as $content)
                    @if (isset($content[$day]))
                        <div class="schedules-item col-xs-12 col-sm-2">
                            <div class="schedules-item-content schedules-item-content--xs-up visible-xs">{{ $day }}</div>
                            <div class="schedules-item-content schedules-item-content--up">{{ $content[$key1] }}</div>
                            <div class="schedules-item-content">{{ $content[$key2] }}</div>
                        </div>
                    @else
                        <div class="schedules-item col-sm-2 hidden-xs">
                            <div class="schedules-item-content">{{ $dayName }}</div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
@endforeach
