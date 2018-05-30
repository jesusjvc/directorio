<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"
        id="myModalLabel">{{ trans('app.edit_customer_account_of_customernames',["customernames" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/customers/' . $customer->id) }}" id="idForm">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.prefix') }} <span class="required"> * </span></label>
                        <select class="form-control" name="prefix" required>
                            @foreach ($prefixes as $prefix)
                                <option value="{{ $prefix->prefix }}"
                                        @if($prefix->prefix == $customer->prefix) selected @endif>{{ trans('app.'.$prefix->prefix) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.firstname') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="firstname" value="{{ $customer->firstname }}"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.lastname') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="lastname" value="{{ $customer->lastname }}"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.email_address') }} <span class="required"> * </span></label>
                        <input type="email" maxlength="100" name="email" value="{{ $customer->email }}"
                               class="form-control"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.cellphone_number') }} <span class="required"> * </span></label>
                        <div class="input-group"> <span class="input-group-addon">+</span>
                            <input type="text" maxlength="100" name="mobile_no"
                                   value="{{ $customer->mobile_no }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.timezone') }} <span class="required"> * </span></label>
                        <select name="timezone" class="form-control select2" required>
                            @foreach ($timezones as $timezone)
                                <option value="{{ $timezone }}" @if($customer->timezone == $timezone) selected @endif>{{ str_replace("_", " ", $timezone) }}</option>
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.default_currency') }} <span class="required"> * </span>
                        </label>
                        <select name="default_currency" class="form-control select2" required>
                            @foreach ($currencies as $currency)
                                <optgroup
                                        label="{{ strtoupper($currency->code) }} : {{ $currency->symbol }}">
                                    <option value="{{ $currency->code }}"
                                            @if($customer->default_currency == $currency->code) selected @endif>{{ strtoupper($currency->name) }}</option>
                                </optgroup>
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.tax_number') }} <span class="required"> <i>{{ trans('app.optional') }}</i> </span></label>
                        <input type="text" maxlength="100" name="tax_number" value="{{ $customer->tax_number }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.paper_size') }} <span class="required"> * </span></label>
                        <select class="form-control" name="paper_size" required>
                            <option value="A4" @if($customer->paper_size == 'A4') selected
                                    @elseif ($profile->paper_size == 'A4') selected @endif>A4
                            </option>
                            <option value="Letter" @if($customer->paper_size == 'Letter') selected
                                    @elseif ($profile->paper_size == 'Letter') selected @endif>Letter
                            </option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
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