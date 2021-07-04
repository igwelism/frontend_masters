@extends('layouts.app')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cart</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(!is_null($cart))
                            <cart-component :cart="{{$cart}}" :cartitemcontent="{{json_encode($cartContents)}}"></cart-component>
                        @else
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Service Content</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="4" style="text-align: center">Cart Contains No Value</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
