@extends('layouts.app', ['activePage' => 'roleManager', 'titlePage' => __('Role List')])

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
                        <h4 class="card-title m-0 pt-2">Role List</h4>
                        @can('role.create')
                        <a href="{{route('role.create')}}" class="btn btn-info px-3">
                            <i class="fa fa-plus pr-1 font-weight-lighter"></i>
                            Add Role
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
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr class="gradeX">
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td style=" width:60%; text-align: center">
                                            @foreach ($role->permissions as $perm)
                                            <span class="badge badge-info">{{$perm->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('role.edit')
                                            <form action="{{route('role.edit', $role->id)}}" method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-sm btn-warning m-1">Edit</button>
                                            </form>
                                            @endcan
                                            @can('role.delete')
                                            <form action="{{route('role.destroy', $role->id)}}" method="POST">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit" class="btn btn-sm btn-danger m-1">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
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
