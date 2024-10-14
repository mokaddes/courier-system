@component('mail::message')
# Test Mail

{{$message['msg']}}.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
