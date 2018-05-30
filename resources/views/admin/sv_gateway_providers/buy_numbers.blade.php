<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.buy_a_did_number_from') }} {{ ucwords($configuration->static_sms_provider->sms_gateway_provider) }}</h4>
</div>
<form role="form" method="POST"
      action="{{ url(Session::get('guard') . '/sv_gateway_providers/'.$configuration->id.'/buy_numbers') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans_choice('app.country',1) }} <span
                            class="required"> * </span></label>
                <select class="form-control select2" name="countrycode" style="width:100%;" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @if(count($countryList) > 0)
                        @foreach($countryList as $country)
                            <option value="{{ $country->code }}">{{ $country->country }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.number_capabilities') }} <span
                            class="required"> * </span></label>
                <div class="radio">
                    <input type="radio" id="sms" name="options" value="sms" checked>
                    <label for="sms">
                        {{ trans('app.sms') }}
                    </label>
                </div>
                <div class="radio">
                    <input type="radio" name="options" value="voice" id="voice">
                    <label for="voice">
                        {{ trans('app.voice') }}
                    </label>
                </div>
                <div class="radio">
                    <input type="radio" name="options" value="sms,voice" id="smsvoice">
                    <label for="smsvoice">
                        {{ trans('app.sms_and_voice') }}
                    </label>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.search') }}</button>
    </div>
</form>
<div class="loadjs">
    @if (Request::ajax())
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    @endif
</div>