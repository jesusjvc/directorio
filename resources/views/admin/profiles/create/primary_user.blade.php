<div class="row">
    <div class="col-md-12">
        <p><i>{{ trans('app.more_users_can_be_added_later') }}
                . {{ trans('app.this_information_will_be_used_to_log_into_the_system') }}</i></p>
        <hr>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.prefix') }} <span class="required"> * </span></label>
            <select class="form-control" name="prefix" required>
                @foreach ($prefixes as $prefix)
                    <option value="{{ $prefix->prefix }}" @if($prefix->prefix == old('prefix')) selected @endif>{{ trans('app.'.$prefix->prefix) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ trans('app.firstname') }} <span class="required"> * </span></label>
            <input type="text" maxlength="100" name="firstname" value="{{ old('firstname') }}"
                   class="form-control" required>
        </div>
        <div class="form-group">
            <label>{{ trans('app.lastname') }} <span class="required"> * </span></label>
            <input type="text" maxlength="100" name="lastname" value="{{ old('lastname') }}"
                   class="form-control" required>
        </div>
    </div>
    @php
        $oldcontact_number = null;
        if((old('mobile_no')) && ((old('mobile_no_prefix')))):
        $oldcontact_number = substr(old('mobile_no'),strlen(old('mobile_no_prefix')));
        endif;
    @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.email_address') }} <span class="required"> * </span></label>
            <input type="email" maxlength="100" name="email" value="{{ old('email') }}" class="form-control"
                   required>
        </div>
        <div class="form-group">
            <label>{{ trans('app.cellphone_number') }} <span class="required"> * </span></label>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control select2" style="width:100%;" name="mobile_no_prefix" required>
                        @foreach ($countryCodes as $countryCode)
                            <option @if($countryCode->code == old('mobile_no_prefix')) selected
                                    @endif value="{{ $countryCode->code }}">
                            +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" maxlength="100" name="mobile_no"
                           @if($oldcontact_number != null) value="{{ $oldcontact_number }}" @endif class="form-control" required>
                </div>
            </div>
        </div>
    </div>
</div>