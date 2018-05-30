@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.register_a_customer_account') }}
@endsection
@section('content')
    @if(Auth::guard('customer')->user() == null)
        <div style="padding:30px;"></div>
    @endif
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.register_a_customer_account') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.register_a_customer_account_at_system', ["system" => Session::get('profile_settings')->business_name]) }}
                    </div>
                    @include('global.customers.create.formbody')
                    <div class="panel-footer">
                        <div class="pull-right">
                            @php
                                $captchaarray = implode(' + ',$captcha);
                            @endphp
                            <div class="form-group">
                                <label>{{ trans('app.captcha', ["sum" => $captchaarray]) }} <span class="required"> * </span></label>
                                <input type="number" min="0" max="50" maxlength="100" name="captcha"
                                       class="form-control" style="width:100%" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <button class="btn btn-primary">{{ trans('app.register_customer') }}</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('head')
@endpush
@push('javascript')

@endpush
<div class="loadjs">
    <script type="text/javascript">
        function FillBilling(f) {
            if (f.copyBillingAddress.checked == true) {
                f.shipping_address_1.value = f.billing_address_1.value;
                f.shipping_address_2.value = f.billing_address_2.value;
                f.shipping_city.value = f.billing_city.value;
                f.shipping_state.value = f.billing_state.value;
                f.shipping_country.value = f.billing_country.value;
                f.shipping_zip.value = f.billing_zip.value;
                $('#shipping_country').val(f.billing_country.value).trigger('change');
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
</div>