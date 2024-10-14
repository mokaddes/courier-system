@component('mail::message')
# Hello {{$admin->name}},


Your password reset otp is {{$otp}},
<br>
Don't share it to any one.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
