<x-mail::message>
# Introduction
    Task Title: {{ $details['title'] }}
    About:      {{$details['message']}}
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
