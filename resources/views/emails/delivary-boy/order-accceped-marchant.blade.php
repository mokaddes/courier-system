@component('mail::message')
# Hello {{$merchant->name}}

Your pickup order, Track ID :**{{$pickupRequest->traking_number}}** has been accepted by {{$deliveryBoy->name}} and its on the way to deliver.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
