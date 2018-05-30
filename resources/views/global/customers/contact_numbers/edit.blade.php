<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_contact_number') }}
            : {{ $contact_number->contact_number }}
            <br>
            <small>{{ ucwords($contact_number->customer->prefix . ' ' . $contact_number->customer->firstname . ' ' . $contact_number->customer->lastname) }}</small>
        </h4>
    </div>
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/customer_contact_numbers/' . $contact_number->id) }}"
          id="idForm"
          @if(Session::get('guard') == 'customer')
          reloadurl="{{ url(Session::get('guard') . '/customer_contact_numbers') }}"
          @else
          reloadurl="{{ url(Session::get('guard') . '/customers/' . $contact_number->customer->id) }}"
            @endif
    >
        <div class="modal-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.contact_number') }} <span class="required"> * </span></label>
                        <select class="form-control" name="number_type" id="number_type" required>
                            <option value="mobile_number"
                                    @if($contact_number->number_type == 'mobile_number') selected @endif>{{ trans('app.mobile_no') }}</option>
                            <option value="landline"
                                    @if($contact_number->number_type == 'landline') selected @endif>{{ trans('app.landline') }}</option>
                            <option value="skype"
                                    @if($contact_number->number_type == 'skype') selected @endif>{{ trans('app.skype') }}</option>
                            <option value="enum"
                                    @if($contact_number->number_type == 'enum') selected @endif>{{ trans('app.enum') }}</option>
                            <option value="sip"
                                    @if($contact_number->number_type == 'sip') selected @endif>{{ trans('app.sip') }}</option>
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
                                <div class="col-md-12">
                                    <div class="input-group"><span class="input-group-addon">+</span>
                                        <input type="text" maxlength="100" name="contact_number" required
                                               value="{{ $contact_number->contact_number }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div id="nonprefixnumber" style="display:none;">
                                <div class="col-md-12">
                                    <input type="text" maxlength="100" name="contact_number_non" required
                                           value="{{ $contact_number->contact_number }}" class="form-control">
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

        function numberType() {

            if ($("#number_type").val() == 'mobile_number') {
                $("#prefixnumber").show();
                $("#nonprefixnumber").hide();
            }
            else if ($("#number_type").val() == 'landline') {
                $("#prefixnumber").show();
                $("#nonprefixnumber").hide();
            }
            else {
                $("#prefixnumber").hide();
                $("#nonprefixnumber").show();
            }
        }

        $(document).ready(function () {
            numberType();
            $("#number_type").on("change", function () {
                numberType();
            });
        });
    </script>
</div>
