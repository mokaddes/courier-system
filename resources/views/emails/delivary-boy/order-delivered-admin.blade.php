@component('mail::message')
# Hello Admin,

Your order Track No : {{$pickup->traking_number}} has been delivered.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
