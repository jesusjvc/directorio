<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.register_a_new_administrator_user_account') }}</h4>
    </div>
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/users') }}" id="idForm">
        <div class="modal-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.prefix') }} <span class="required"> * </span></label>
                        <select class="form-control" name="prefix" required>
                            @foreach ($prefixes as $prefix)
                                <option value="{{ $prefix->prefix }}"
                                        @if((old('prefix'))&&(old('prefix') == $prefix->prefix)) selected @endif>{{ trans('app.'.$prefix->prefix) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.firstname') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="firstname" value="{{ old('firstname') }}"
                               class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.lastname') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="lastname" value="{{ old('lastname') }}"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('app.email_address') }} <span class="required"> * </span></label>
                        <input type="email" maxlength="100" name="email" value="{{ old('email') }}" class="form-control"
                               required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.cellphone_number') }} <span class="required"> * </span></label>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control select2" name="mobile_no_prefix" required>
                                    @foreach ($countryCodes as $countryCode)
                                        <option @if($countryCode->code == old('mobile_no_prefix')) selected
                                                @endif value='{{ $countryCode->code }}'>
                                            +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" maxlength="100" name="mobile_no"
                                       value="{{ old('mobile_no') }}" class="form-control" required>
                            </div>
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