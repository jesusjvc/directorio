@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.password_reset') }}
@endsection
@section('content')
    <div style="padding:45px;"></div>
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <h3 class="box-title m-b-20">{{ trans('app.reset_your_password') }}</h3>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <label for="email" class="control-label">{{ trans('app.email_address') }}</label>
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ $email or old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <label for="password" class="control-label">{{ trans('app.password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <label for="password-confirm" class="control-label">{{ trans('app.confirm_password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('app.reset_password') }}
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <a href="{{ url('customer/login') }}" id="to-recover" class="text-dark pull-right"><i
                                    class="fa  fa-arrow-circle-left m-r-5"></i> {{ trans('app.go_to_login') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
