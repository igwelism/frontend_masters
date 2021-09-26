@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cleaning</li>
        </ol>
    </nav>
    <img src="{{ asset('images/cleaning/house-cleaning.jpg') }}" class="img-fluid" alt="cleaning">
    <div class="card text-center">
        <div class="card-header services-background">
            How It Works
        </div>
        <div class="card-deck">
            <div class="card text-white bg-info mb-3" style="font-size:medium; width: 18rem;">
                <div class="card-header"><strong>Choose your plan</strong></div>
                <div class="card-body">
                    <p class="card-text">Choose the type of cleaning you want, select how often you'd like your home cleaned, and pay.</p>
                </div>
            </div>
            <div class="card text-white bg-primary mb-3" style="font-size:medium;width: 18rem;">
                <div class="card-header"><strong>We get scrubbing</strong></div>
                <div class="card-body">
                    <p class="card-text">Our team of trained cleaners visit your home, polishing surfaces, mopping floors, scrubbing dishes, and making sure your home looks pristine.</p>
                </div>
            </div>
            <div class="card text-white bg-success mb-3" style="font-size:medium;width: 18rem;">
                <div class="card-header"><strong>We supervise</strong></div>
                <div class="card-body">
                    <p class="card-text">We ensure that the cleaning is done excellently, so there's no need for you to supervise. Just come to a tidy surrounding </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header concierge-background text-center">
            Categories
        </div>
        <cleaning-component :cleaning="{{$cleaning}}" :cartcontents="{{json_encode($cartContents)}}"></cleaning-component>
    </div>
@endsection
