<div class="col-xs-12">
        @foreach ($data as $content)
            @if ($loop->first)
                <div class="row">
            @endif

            @if ($loop->iteration % 4 == 0)
                </div>
                <div class="row">
            @endif

            <div class="col-xs-12">
                <div class="col-xs-12">
                    <img src="{{ $content['img'] }}" alt="{{ $content['name'] }}" class="img">
                </div>
                <div class="col-xs-12">{{ $content['name'] }}</div>
                <div class="col-xs-12">{{ $content['role'] }}</div>
            </div>

            @if ($loop->last)
                </div>
            @endif
        @endforeach
</div>
