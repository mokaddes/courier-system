@component('mail::message')
# Hello {{$merchant->name}}


Your order Track No : {{$pickup->traking_number}} has been delivered.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
