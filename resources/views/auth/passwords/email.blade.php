@extends('auth.layout')
@section('content')
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <div class="white-box">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('password/email') }}">
                    {{ csrf_field() }}

                    <h3 class="text-center">{{ Session::get('profile_settings')->business_name }}</h3>
                    @if (Session('status'))
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! Session::get('status') !!}
                        </div>
                    @endif
                    <hr/>

                    <p class="text-muted text-center">{{ trans('app.to_reset_your_password_enter_you_account_email_address_below') }} </p>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="col-md-12">
                            <label for="email" class="control-label">{{trans('app.email_address')}}</label>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ trans('app.send_password_reset_link') }}
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{ url('login') }}" id="to-recover" class="text-dark pull-right"><i
                                        class="fa  fa-arrow-circle-left m-r-5"></i> {{ trans('app.back_to_login') }}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection