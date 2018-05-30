<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.add_a_contact_number') }}
            <br>
            <small>{{ ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname) }}</small>
        </h4>
    </div>
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $profile->id . '/user_contact_numbers/' . $user->id) }}" id="idForm"
          reloadurl="{{ url(Session::get('guard') . '/' . $profile->id . '/users') }}">
        <div class="modal-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.contact_number') }} <span class="required"> * </span></label>
                        <select class="form-control" name="number_type" id="number_type" required>
                            <option value="mobile_number">{{ trans('app.mobile_no') }}</option>
                            <option value="landline">{{ trans('app.landline') }}</option>
                            <option value="skype">{{ trans('app.skype') }}</option>
                            <option value="enum">{{ trans('app.enum') }}</option>
                            <option value="sip">{{ trans('app.sip') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.contact_number') }} <span class="required"> * </span></label>
                        <div class="row">
                            <div id="prefixnumber">
                                <div class="col-md-6">
                                    <select class="form-control select2" name="contact_number_prefix">
                                        @foreach ($countryCodes as $countryCode)
                                            <option @if($countryCode->code == old('contact_number_prefix')) selected
                                                    @endif value='{{ $countryCode->code }}'>
                                                +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" maxlength="100" name="contact_number"
                                           value="{{ old('contact_number') }}" class="form-control">
                                </div>
                            </div>
                            <div id="nonprefixnumber" style="display:none;">
                                <div class="col-md-12">
                                    <input type="text" maxlength="100" name="contact_number_non"
                                           value="{{ old('contact_number') }}" class="form-control">
                                </div>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $("#number_type").on("change", function () {
                if (this.value == 'mobile_number') {
                    $("#prefixnumber").show();
                    $("#nonprefixnumber").hide();
                }
                else if (this.value == 'landline') {
                    $("#prefixnumber").show();
                    $("#nonprefixnumber").hide();
                }
                else {
                    $("#prefixnumber").hide();
                    $("#nonprefixnumber").show();
                }
            })
        });
    </script>
</div>