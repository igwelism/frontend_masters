@extends('layouts.app')

@section('content')
    <img src="{{ asset('images/food/food.jpg') }}" class="img-fluid" alt="food">
    <div class="card text-center">
        <div class="card-header services-background">
            How It Works
        </div>
        <div class="card-deck">
            <div class="card text-white bg-info mb-3" style="font-size:medium; width: 18rem;">
                <div class="card-header"><strong>Choose your plan</strong></div>
                <div class="card-body">
                    <p class="card-text">Choose the meals you want from our menu, select how often you'd like your meals, and pay.</p>
                </div>
            </div>
            <div class="card text-white bg-primary mb-3" style="font-size:medium;width: 18rem;">
                <div class="card-header"><strong>We get cooking</strong></div>
                <div class="card-body">
                    <p class="card-text">Our team of expert chefs take it from here, preparing your culinary fantasies with the freshest ingredients.</p>
                </div>
            </div>
            <div class="card text-white bg-success mb-3" style="font-size:medium;width: 18rem;">
                <div class="card-header"><strong>We Deliver</strong></div>
                <div class="card-body">
                    <p class="card-text">Food is ready and on it's way to you. You can eat immediately or freeze for later.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header concierge-background text-center">
            Our Menu
        </div>
        <food-component :food="{{$foods}}" :cartcontents="{{json_encode($cartContents)}}"></food-component>
    </div>
@endsection
