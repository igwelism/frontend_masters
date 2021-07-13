@extends('navigation.employee')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12" style="background-color: white">
                <div class="card text-center">
                    <div class="card-header services-background">
                        Upload Services
                    </div>
                </div>
                <service-component></service-component>
                <hr>
                @include('layouts._messages')
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Food
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Sku</th>
                                            <th scope="col">Image Uploaded</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($foods) > 0)
                                            @foreach($foods as $food)
                                                <tr>
                                                    <th scope="row">{{$food->name}}</th>
                                                    <td>{{$food->sku}}</td>
                                                    @if($food->img)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>{{$food->category}}</td>
                                                    <td>{{$food->status}}</td>
                                                    <td>
                                                        <form class="form-delete" method="post" action="{{ route('food.destroy', $food->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $foods->links() }}
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">No food</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Laundry
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Sku</th>
                                            <th scope="col">Image Uploaded</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($laundries) > 0)
                                            @foreach($laundries as $laundry)
                                                <tr>
                                                    <th scope="row">{{$laundry->name}}</th>
                                                    <td>{{$laundry->sku}}</td>
                                                    @if($laundry->img)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>{{$laundry->category}}</td>
                                                    <td>{{$laundry->quantity}}</td>
                                                    <td>{{$laundry->status}}</td>
                                                    <td>
                                                        <form class="form-delete" method="post" action="{{ route('laundry.destroy', $laundry->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $laundries->links() }}
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">No food</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Cleaning
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Sku</th>
                                            <th scope="col">Image Uploaded</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($cleaning) > 0)
                                            @foreach($cleaning as $clean)
                                                <tr>
                                                    <th scope="row">{{$clean->name}}</th>
                                                    <td>{{$clean->sku}}</td>
                                                    @if($clean->img)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>{{$clean->category}}</td>
                                                    <td>{{$clean->quantity}}</td>
                                                    <td>{{$clean->status}}</td>
                                                    <td>
                                                        <form class="form-delete" method="post" action="{{ route('cleaning.destroy', $clean->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $cleaning->links() }}
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">No food</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
