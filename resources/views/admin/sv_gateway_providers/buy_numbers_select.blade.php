@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.configuration') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.buy_a_did_number_from') }}
                    : {{ ucwords($configuration->static_sms_provider->sms_gateway_provider) }} : {{ $country->country }}
                    <div class="pull-right sectionbuttons">
                        <a href="{{ url(Session::get('guard') . '/sms_provider_configurations') }}">
                            <button class="btn btn-xs btn-success">
                                {{ trans('app.cancel_and_go_back') }}
                            </button>
                        </a>
                    </div>
                </div>
                <form role="form" method="POST"
                      action="{{ url(Session::get('guard') . '/sv_gateway_providers/'.$configuration->id.'/buy_numbers_purchase') }}"
                      reloadurl="{{ url(Session::get('guard') . '/sv_gateway_providers/'.$configuration->id.'/buy_numbers') }} }}">
                    <input type="hidden" name="country" value="{{ $country->code }}"> {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="form-body">
                            <label>{{ trans('app.select_one_number_you_would_like_to_purchase') }} <span
                                        class="required"> * </span></label>
                            <table class="table table-striped">
                                <tbody>
                                @php $i = 0; @endphp @foreach ($numbersResult as $instance)
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <input type="radio" name="msisdn" value="{{ $instance->msisdn }}" id="x{{ $i }}"
                                                       @if($i==0) checked @endif>
                                                <label for="x{{ $i }}">
                                                    @if((isset($instance->cost)) && ($instance->cost != 0))
                                                    <input type="hidden" name="cost[{{ $instance->msisdn }}]"
                                                           value="{{ $instance->cost }}">
                                                @else
                                                        <input type="hidden" name="cost[{{ $instance->msisdn }}]"
                                                               value="0.00">
                                                        @endif

                                                    <mark>
                                                        +{{ $instance->msisdn }}</mark> @if((isset($instance->cost)) && ($instance->cost != 0)) @ {{ $instance->cost }} {{ trans('app.per_month') }} @endif {{ trans('app.with_features') }}
                                                    : @foreach ($instance->features as $feature)
                                                        <strong>{{ $feature }}</strong>, @endforeach
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('app.purchase_the_selected_number') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush