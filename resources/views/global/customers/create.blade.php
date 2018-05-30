@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.customers') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ url(Session::get('guard') . '/customers/create') }}">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.register_a_new_customer_account') }}
                        <div class="pull-right">
                            <a href="{{ url(Session::get('guard') . '/customers') }}">
                                <span class="btn btn-xs btn-primary">
                                    {{ trans('app.cancel_and_go_back') }}
                                </span>
                            </a>
                        </div>
                    </div>
                    @include('global.customers.create.formbody')
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary">{{ trans('app.register_customer') }}</button>
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
</div>