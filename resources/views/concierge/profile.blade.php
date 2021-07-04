@extends('layouts.app')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12" style="background-color: white">
                <div class="card text-center">
                    <div class="card-header services-background">
                        Personal Details
                    </div>
                </div>
                <profile-component :user="{{$user}}"></profile-component>
            </div>
        </div>
    </div>
@endsection
