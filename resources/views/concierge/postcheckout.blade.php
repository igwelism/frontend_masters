@extends('layouts.app')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header services-background">
                        Your Subscription Has Been Received
                    </div>
                    <h4 class="mt-4">Thank you for your subscription</h4>
                    <p>Your order # is {{ $order->order_no }}</p>
                    <p>You will receive a confirmation email with details of your subscription</p>
                    <p>Use Instant Transfer to transfer <b>GBP {{ $order->total }}</b> to our account</p>
                    <div class="card center" style="width: 25rem; font-weight: bolder">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>Name:</td>
                                <td>Concierge Limited Company</td>
                            </tr>
                            <tr>
                                <td>Account Number:</td>
                                <td>01022339845</td>
                            </tr>
                            <tr>
                                <td>Bank:</td>
                                <td>Halifax Bank</td>
                            </tr>
                        </table>
                    </div>
                    <p>Your reference is your name or email. Once done, email us at <a href="mailto:sales@concierge.co.uk">sales@concierge.co.uk</a></p>
                    <div class="card center mb-4" style="width: 18rem;">
                        <button onclick="window.location.href='/'" type="button" class="btn btn-secondary btn-lg ">Goto Homepage</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
