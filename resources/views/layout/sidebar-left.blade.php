<div class="sidebar sidebar--left hidden-xs col-sm-4 col-md-3">
    @include('partials.sidebar.schedules', $schedules)

    <imc></imc>

    @php $showVideos = $sidebarVideos ?? true; @endphp
    @if ($showVideos)
        @include('partials.sidebar.videos', $videos)
    @endif
</div>
