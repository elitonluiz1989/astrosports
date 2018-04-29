<div class="row row-reset justify-content-center justify-content-md-start">
    @foreach ($records as $record)
        <div class="about__team col-10 col-sm-9 col-md-6 col-lg-4">
            <div class="about__team-avatar about__team-content">
                <img src="{{ $record->source }}" alt="{{ $record->alt }}" class="img">
            </div>

            <div class="about__team-name about__team-content">{{ $record->name }}</div>

            <div class="about__team-role about__team-content">{{ $record->role }}</div>
        </div>
    @endforeach
</div>

