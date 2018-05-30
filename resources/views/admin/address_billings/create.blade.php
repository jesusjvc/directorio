<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.register_a_new_billing_address') }}
        <br>
        <small>{{ $profile->business_name }}</small>
        </h4>
    </div>
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/profiles/'.$profile->id.'/address_billings') }}" id="idForm"
          reloadiv="{{ Request::segment(6) }}" reloadurl="{{ url(Session::get('guard') . '/profiles/'.$profile->id.'/address_billings') }}">
        <div class="modal-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.friendly_name') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="friendly_name" value="{{ old('friendly_name') }}"
                               class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="address_1" value="{{ old('address_1') }}"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.address_2') }}</label>
                        <input type="text" maxlength="100" name="address_2" value="{{ old('address_2') }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="city" value="{{ old('city') }}" class="form-control"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.just_country') }} <span class="required"> * </span></label>
                        <select class="form-control select2" name="country" required>
                            @foreach ($countryList as $country)
                                <option value="{{ $country->code }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.postal_code') }} </label>
                        <input type="text" maxlength="100" name="postal_code" value="{{ old('postal_code') }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.state') }} </label>
                        <input type="text" maxlength="100" name="state" value="{{ old('state') }}"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
        </div>
    </form>
</div>
<div class="loadjs">
    @if (Request::ajax())
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    @endif
</div>