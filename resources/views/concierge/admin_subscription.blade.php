@extends('navigation.employee')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12" style="background-color: white">
                <div class="card text-center">
                    <div class="card-header faq-background">
                        Subscription
                    </div>
                </div>
                <admin-subscription-component :order="{{$order}}"></admin-subscription-component>
            </div>
        </div>
    </div>
@endsection
