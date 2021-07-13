@extends('navigation.employee')

@section('content')
    <div class="card text-center">
        <div class="card-header services-background">
            Admin Dashboard
        </div>
        <div class="card-deck mt-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/food.jpg') }}" class="card-img-top" alt="food">
                <div class="card-body">
                    <h5 class="card-title"><strong>Subscription</strong></h5>
                    <a href="{{route('admin.subscription')}}" class="btn btn-primary">Details</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/laundry.jpg') }}" class="card-img-top" alt="laundry">
                <div class="card-body">
                    <h5 class="card-title"><strong>Customers</strong></h5>
                    <a href="{{route('admin.customer')}}" class="btn btn-primary">Details</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/cleaning.jpg') }}" class="card-img-top" alt="Home Cleaning">
                <div class="card-body">
                    <h5 class="card-title"><strong>Upload Services</strong></h5>
                    <a href="{{route('admin.upload')}}" class="btn btn-primary">Details</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/cleaning.jpg') }}" class="card-img-top" alt="Home Cleaning">
                <div class="card-body">
                    <h5 class="card-title"><strong>Admin User</strong></h5>
                    <a href="{{route('admin.register')}}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
    </div>
@endsection
