@extends('layouts.app', ['activePage' => 'editUser', 'titlePage' => __('Edit User')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						">
                        <h4 class="card-title m-0 pt-2">Edit User</h4>
                        <a href="{{route('user.index')}}" class="btn btn-info px-3">
                            <i class="fa fa-plus pr-1 font-weight-lighter"></i>
                            View User List
                        </a>
                        <!-- <p class="card-category">Manage customer page</p> -->
                    </div>
                    <div class="card-body">

                        @if(session('message'))
                        <div class="alert alert-{{session('type')}}">{{session('message')}}</div>
                        @endif
                        <form action="{{route('user.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">User Name *</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                                        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="role">Role Name *</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($roles as $role)
                                            <option value="{{$role->id}}" {{$user->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('role')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mr-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
