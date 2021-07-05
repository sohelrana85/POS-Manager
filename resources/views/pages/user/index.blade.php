@extends('layouts.app', ['activePage' => 'UserManager', 'titlePage' => __('User List')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						">
                        <h4 class="card-title m-0 pt-2">User List</h4>
                        @can('user.create')
                        <a href="{{route('user.create')}}" class="btn btn-info px-3">
                            <i class="fa fa-plus pr-1 font-weight-lighter"></i>
                            Add User
                        </a>
                        @endcan
                        <!-- <p class="card-category">Manage customer page</p> -->
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                        <div class="alert alert-{{session('type')}}">{{session('message')}}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr class="gradeX">
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                            <span class="badge badge-info">{{$role->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('user.edit')
                                            <form action="{{route('user.edit', $user->id)}}" method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-sm btn-warning m-1">Edit</button>
                                            </form>
                                            @endcan
                                            @can('user.delete')
                                            <form action="{{route('user.destroy', $user->id)}}" method="POST">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit" class="btn btn-sm btn-danger m-1">Delete</button>
                                            </form>
                                            @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
