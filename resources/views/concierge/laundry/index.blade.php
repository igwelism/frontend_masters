@extends('layouts.app')

@section('content')
    <img src="{{ asset('images/laundry/laundry_page_image.jpg') }}" class="img-fluid" alt="laundry">
    <div class="card text-center">
        <div class="card-header services-background">
            How It Works
        </div>
        <div class="card-deck">
            <div class="card text-white bg-info mb-3" style="font-size:medium; width: 18rem;">
                <div class="card-header"><strong>Choose your plan</strong></div>
                <div class="card-body">
                    <p class="card-text">Choose the number of laundry bags you need cleaned. Select how often you'd like us to do your laundry in a month, and pay</p>
                </div>
            </div>
            <div class="card text-white bg-primary mb-3" style="font-size:medium;width: 18rem;">
                <div class="card-header"><strong>We pickup and clean</strong></div>
                <div class="card-body">
                    <p class="card-text">We come over to you home/office and pick up your dirty laundry. Then we wash, dry and iron to perfection.</p>
                </div>
            </div>
            <div class="card text-white bg-success mb-3" style="font-size:medium;width: 18rem;">
                <div class="card-header"><strong>We Deliver</strong></div>
                <div class="card-body">
                    <p class="card-text">That's it. Your fresh clothes are ready and on their way to you. All within 48 hrs.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header concierge-background text-center">
            Categories
        </div>
        <laundry-component :laundry="{{$laundries}}" :cartcontents="{{json_encode($cartContents)}}"></laundry-component>
    </div>
@endsection
