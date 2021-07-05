@component('mail::message')
# Order Confirmation Email

**Dear {{$order->customer_fullname}},**<br>
<p>This is a notification of your order {{$order->order_no}} on Concierge.</p>

@component('mail::table')
    | Order Number             | Status                      |
    | -------------------------|:---------------------------:|
    | {{$order->order_no}}     | {{ $order->payment_status }}|
@endcomponent

@if($order->payment_status == "Pending")
    <p>Use Instant Transfer to transfer GBP {{ $order->total }} to our account:</p>
    <p>Name: Concierge Limited Company<br>
    Account Number: 01022339845<br>
    Bank: Halifax Bank</p>

    <p>Please note that we need to have received your payment before your subscription can be started.</p>
    <p>Your reference is your name or email. Once done, email us at <a href="mailto:sales@concierge.co.uk">sales@concierge.co.uk</a></p>
@endif

<p>If you have any questions, you may reach us at <a href="mailto:customer@concierge.co.uk">customer@concierge.co.uk</a></p>

Thank You,<br>
{{ config('app.name') }}
@endcomponent
