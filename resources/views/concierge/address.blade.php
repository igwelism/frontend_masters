@extends('layouts.app')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12" style="background-color: white">
                <div class="card text-center">
                    <div class="card-header concierge-background">
                        Address
                    </div>
                </div>
                <address-component :user="{{$user}}"></address-component>
            </div>
        </div>
    </div>
@endsection
