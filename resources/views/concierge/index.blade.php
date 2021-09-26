@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="content-flow">
                        <div class="image-sidebar">
                            <div>
                                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                        <li data-target=e"#carouselExampleCaptions" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('images/cooking.jpg') }}" class="d-block w-100" alt="cooking">
                                            <div class="carousel-caption d-none d-md-block">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0,0,0,0.6);">
                                                    <h4><strong>Say goodbye to long cooking hours forever</strong></h4>
                                                    <p>We take care of your chores, so you can get more out of life. It's what you've always dreamed of.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('images/laundry_slide.jpg') }}" class="d-block w-100" alt="laundry">
                                            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0,0,0,0.6);">
                                                <h4><strong>Say goodbye to laundry day forever</strong></h4>
                                                <p>We take care of your chores, so you can get more out of life. It's what you've always dreamed of.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('images/cleaning-slide.jpg') }}" class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0,0,0,0.6);">
                                                <h4><strong>Say goodbye to house cleaning forever</strong></h4>
                                                <p>We take care of your chores, so you can get more out of life. It's what you've always dreamed of.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex flex-column">
                                    <div style="color:white">
                                        <div style="background-color: rgba(0,0,0,0.6);; position: absolute;margin: 0 auto;">
                                            <p><strong>Say goodbye to market runs forever</strong></p>
                                        </div>
                                        <img src="{{ asset('images/market.jpg') }}" class="d-block w-100" alt="...">
                                        <div style="background-color: rgba(0,0,0,0.6);; position: absolute;margin: 0 auto;">
                                            <p><strong>Food is sorted</strong></p>
                                        </div>
                                        <img src="{{ asset('images/food_needs.jpg') }}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-header services-background">
                        Services
                    </div>
                    <div class="card-deck">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('images/food.jpg') }}" class="card-img-top" alt="food">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Food</strong></h5>
                                <p class="card-text">Your chef-cooked meals, delivered to you. Daily or weekly</p>
                                <a href="{{ route('food.index') }}" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('images/laundry.jpg') }}" class="card-img-top" alt="laundry">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Laundry</strong></h5>
                                <p class="card-text">Your clothes, picked up, laundered and delivered to you in 48 hours or less.</p>
                                <a href="{{ route('laundry.index') }}" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('images/cleaning.jpg') }}" class="card-img-top" alt="Home Cleaning">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Home Cleaning</strong></h5>
                                <p class="card-text">Professional cleaning at your doorstep. Up to thrice a week</p>
                                <a href="{{ route('cleaning.index') }}" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-header concierge-background">
                        Why Concierge?
                    </div>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/FlKqlNPs8ho" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header faq-background text-center">
                        Frequently Asked Questions
                    </div>
                    <div class="content-flow">
                        <div class="faq-layout">
                            <div class="col">
                                <strong style="font-size: xx-large">You have questions? We have answers.</strong>
                            </div>
                            <div class="col">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    A laundry service, cleaning service or food service?
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                We do all three. But you get to decide which works best for you. If you need food, we'll get you delicious meals everyday, once a week, or every two weeks. Dirty laundry? We'll pick them up and bring back your clothes, freshly washed folded/ironed. Does your home need cleaning? We'll get that done efficiently as well.
                                                You can even subscribe for more than one service, and we'll run it. Perfectly.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    How does it work?
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                When you sign up on Concierge, you can configure a plan that fits your needs, then you get assigned a pruner to help you manage your home. The website takes your food, laundry, and home cleaning needs and turns them into tasks that our pruner attend to on schedule. You will get frequent notifications as tasks are accomplished.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Does my pruner service me alone?
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                Your pruner’s schedule is designed to give the best attention to your chores, which gives them enough time to attend to a few other customers in the same area as you. This means that our pruners attend to a handful of customers, but are never swamped with requests.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
