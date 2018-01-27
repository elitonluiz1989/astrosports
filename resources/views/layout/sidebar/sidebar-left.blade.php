<div class="sidebar-left d-none d-sm-block col-sm-5 col-md-4 col-lg-3">
    @include('layout.sidebar.advertising', ['advertising' => $advertising])

    @include('layout.sidebar.schedules', $schedules)

    <imc></imc>

    @php $showVideos = $showVideos ?? true; @endphp
    @if ($showVideos)
        @include('layout.sidebar.videos', $videos)
    @endif
</div>
