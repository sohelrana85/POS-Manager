@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                            {{-- <p class="card-category">{{ __('User information') }}</p> --}}
                        </div>
                        <div class="card-body ">

                            @if (session('status'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>{{ session('status') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Name') }}</label>
                                        <div class="form-row{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true" />
                                            @if ($errors->has('name'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <div class="form-row{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                                            @if ($errors->has('email'))
                                            <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <img src="upload_file/pp/{{auth()->user()->profile_pic}}" class="rounded-circle border" alt="Profile Pic" style="width:83px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_pic">{{ __('Change Photo') }} <small>[ Example: 100x100 ]</small></label>
                                        <input class="form-control{{ $errors->has('profile_pic') ? ' is-invalid' : '' }}" name="profile_pic" id="profile_pic" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="col-md-12">
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                </div>
                <div class="card-body ">
                    @if (session('status'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('status') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true" />
                                @if ($errors->has('name'))
                                <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                                @if ($errors->has('email'))
                                <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
            </form>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
                @csrf
                @method('put')

                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Change password') }}</h4>
                        {{-- <p class="card-category">{{ __('Password') }}</p> --}}
                    </div>
                    <div class="card-body ">
                        @if (session('status_password'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status_password') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                                    @if ($errors->has('old_password'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                                    @if ($errors->has('password'))
                                    <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
