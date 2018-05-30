<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.send_test_sms') }}
        : {{ $configuration->configuration_nickname }}</h4>
</div>
<form role="form" method="POST"
      action="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id . '/validate_connection') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/sms_provider_configurations') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.from_did_number') }}</label>
                        <select class="form-control" name="did_number" required>
                            @foreach ($did_numbers as $did_number)
                                @if(is_numeric($did_number->did_number))
                                    <option value="{{ $did_number->did_number }}">+{{ $did_number->did_number }}</option>
                                @else
                                    <option value="{{ $did_number->did_number }}">{{ $did_number->did_number }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.country_area_code') }}</label>
                        <select class="form-control select2" name="contact_number[contact_number_prefix]" required>
                            @foreach ($countryCodes as $countryCode)
                                <option value="{{ $countryCode->code }}"
                                        @if($countryCode->code == Session::get('profile_settings')->default_sms_country_code) selected @endif >
                                    +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.contact_number') }} <span class="required"> * </span></label>
                        <input type="number" name="contact_number[contact_number]" maxlength="100" class="form-control"
                               required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.send_test_sms') }}</button>
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
