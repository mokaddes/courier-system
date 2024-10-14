@component('mail::message')
# Hello Admin
You got a new pickup request. <br>
Here Some Details, <br>
<br>
**Send form :** {{$pickupRequest->hasMerchant->business_name ?? ""}} <br>
**Pickup Location :**  {{$pickupRequest->city->name.', ' ?? "". $pickupRequest->hasPickupState->name.', ' ?? ""}}{{$pickupRequest->pickup_street_address.', ' ?? ""}} {{$pickupRequest->pickup_zip?? ""}} <br>
**Delivery Method :** {{$pickupRequest->hasPriceGroup->name}} <br>
**Cod :** {{getPrice($pickupRequest->amount)}} <br>
**Payment Status :** {{$pickupRequest->payment_status ? "Paid" : "Unpaid"}} <br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
