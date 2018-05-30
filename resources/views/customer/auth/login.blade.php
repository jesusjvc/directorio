@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.login') }}
@endsection
@section('content')
    <div style="padding:45px;"></div>
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/login') }}">
                {{ csrf_field() }}
                <h3 class="text-center">{{ Session::get('profile_settings')->business_name }}
                    <br>
                    <small>
                        {{ trans('app.customer_control_panel') }}
                    </small>
                </h3>

                <hr/>

                @if(Session::has('flash_message'))
                    <span class="help-block">
                            {!! Session::get('flash_message') !!}
                        </span>
                @endif

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <label for="email" class="control-label">{{ trans('app.email_address') }}</label>
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required autofocus>

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
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember"> {{ trans('app.remember_me') }} </label>
                        </div>
                        <a href="{{ url('customer/password/reset') }}" id="to-recover" class="text-dark pull-right"><i
                                    class="fa fa-lock m-r-5"></i> {{ trans('app.forgot_password') }}</a>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                type="submit">{{ trans('app.sign_in') }}
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('register') }}" class="text-dark"> {{ trans('app.register_a_customer_account') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection