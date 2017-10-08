@component('mail::message')

    @component('mail::panel')
        {{  $sender['subject'] }}
    @endcomponent

    {{ $sender['content'] }}

@endcomponent