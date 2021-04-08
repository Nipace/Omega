@extends('layouts.standalone', ['class' => 'bg-default'])

@section('title')
Reset Password | Omega Secondary School
@endsection
@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center">{{ __('Reset Password') }}</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route('reset.password') }}" autocomplete="off">
                            @csrf

                            <div class="form-group{{ $errors->has('currentpassword') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('currentpassword') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" type="password" name="currentpassword" required autofocus>
                                </div>
                                @if ($errors->has('currentpassword'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('currentpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('newpassword') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" name="newpassword" placeholder="{{ __(' New Password') }}" type="password" required>
                                </div>
                                @if ($errors->has('newpassword'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif
                                </div>
                         
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
