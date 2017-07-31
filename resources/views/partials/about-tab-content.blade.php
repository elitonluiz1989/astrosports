@foreach ($data as $content)
    @php $src  = $content->cover ?? config('about.team.img'); @endphp
    <div class="about__team col-xs-12 col-sm-4">
        <div>{{ $content->cover }}</div>
        <div class="about__team-content">
            <img src="{{ $src }}?w=300&h=250" alt="{{ $content->alt }}" class="img">
        </div>
        <div class="about__team-name about__team-content">{{ $content->name }}</div>
        <div class="about__team-content">{{ $content->role }}</div>
    </div>
@endforeach
