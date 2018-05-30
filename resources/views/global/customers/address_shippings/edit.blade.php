<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_shipping_address') }} : {{ $address->friendly_name }}
            <br>
            <small>{{ ucwords($address->customer->prefix . ' ' . $address->customer->firstname . ' ' . $address->customer->lastname) }}</small></h4>
    </div>
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/customer_shipping_address/' . $address->id) }}" id="idForm"
          @if(Session::get('guard') == 'customer')
          reloadurl="{{ url(Session::get('guard') . '/address_management') }}"
          @else
          reloadurl="{{ url(Session::get('guard') . '/customers/' . $address->customer->id) }}"
            @endif
    >
        <div class="modal-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.friendly_name') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="friendly_name" value="{{ $address->friendly_name }}"
                               class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="address_1" value="{{ $address->address_1 }}"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.address_2') }}</label>
                        <input type="text" maxlength="100" name="address_2" value="{{ $address->address_2 }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="city" value="{{ $address->city }}" class="form-control"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.just_country') }} <span class="required"> * </span></label>
                        <select class="form-control select2" name="country" required>
                            @foreach ($countryList as $country)
                                <option value="{{ $country->code }}"
                                        @if($address->country == $country->code) selected @endif>{{ $country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.postal_code') }} </label>
                        <input type="text" maxlength="100" name="postal_code" value="{{ $address->postal_code }}"
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