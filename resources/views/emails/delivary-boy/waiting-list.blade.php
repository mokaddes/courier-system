@component('mail::message')
# Hello {{$deliveryBoy->name}},<br>

A new order waiting for you, <br>

Here some of the order details,<br>
**Tracking Number :** {{$pickupRequest->traking_number ?? ""}} <br>
**Send form :** {{$pickupRequest->hasMerchant->business_name ?? ""}} <br>
**Pickup Location :**  {{$pickupRequest->city->name.', ' ?? "". $pickupRequest->hasPickupState->name.', ' ?? ""}}{{$pickupRequest->pickup_street_address.', ' ?? ""}} {{$pickupRequest->pickup_zip?? ""}} <br>
**Send To :** {{$pickupRequest->delivery_contact_name?? ""}} <br>
**Delivery Location :** {{$pickupRequest->deliveryCity->name.', ' ?? "". $pickupRequest->hasDeliveryState->name.', ' ?? ""}}{{$pickupRequest->delivery_street_address.', ' ?? ""}} {{$pickupRequest->delivery_zip?? ""}} <br>
**Delivery Method :** {{$pickupRequest->hasPriceGroup->name}} <br>
**Amount :** {{getPrice($pickupRequest->amount)}} <br>
**Payment Status :** {{$pickupRequest->payment_status ? "Paid" : "Unpaid"}} <br>





Thanks,<br>
{{ config('app.name') }}
@endcomponent
