@extends('navigation.employee')

@section('content')
    <div style="font-size: medium">
        <div class="row justify-content-center">
            <div class="col-md-12" style="background-color: white">
                <div class="card text-center">
                    <div class="card-header services-background">
                        Add New Employee
                    </div>
                </div>
                <admin-user-component></admin-user-component>
                <hr>
                @include('layouts._messages')
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Employee
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">FullName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Employee Id</th>
                                            <th scope="col">Have Password</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($adminUsers) > 0)
                                            @foreach($adminUsers as $adminUser)
                                                <tr>
                                                    <th scope="row">{{$adminUser->fullname}}</th>
                                                    <td>{{$adminUser->email}}</td>
                                                    <td>{{$adminUser->employee_id}}</td>
                                                    @if($adminUser->employee_password)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>
                                                        <form class="form-delete" method="post" action="{{ route('employee.destroy', $adminUser->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            @if($adminUser->employee_id != \Illuminate\Support\Facades\Auth::user()->employee_id)
                                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $adminUsers->links() }}
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">No Employee</td>
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
