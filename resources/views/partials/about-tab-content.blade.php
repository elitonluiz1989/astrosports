@foreach ($records as $record)
    <div class="about__team col-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-4 col-lg-3">
        <div class="about__team-avatar about__team-content">
            <img src="{{ $record->img }}" alt="{{ $record->alt }}" class="img">
        </div>
        <div class="about__team-name about__team-content">{{ $record->name }}</div>
        <div class="about__team-role about__team-content">{{ $record->role }}</div>
    </div>
@endforeach
