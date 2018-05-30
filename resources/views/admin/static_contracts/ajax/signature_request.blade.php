<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.electronic_signature_request') }}<br>
        <small>{{ $contract->title }}</small>
    </h4>
</div>
<form role="form" method="POST"
      action="{{ url(Session::get('guard') . '/static_contracts/' . $contract->id . '/electronic_signature_request') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/static_contracts') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <label>{{ trans('app.recipient_search') }} <span
                                class="required"> * </span></label>
                    <small><i>{{ trans('app.this_can_be_a_profile_owner_customer_account_or_user_account') }}</i>
                    </small>
                    <div class="form-group">
                        <select name="find_id" class="form-control profile_customer_search"
                                required>
                            <option value=""
                                    selected>{{ trans('app.search_for_a_recipient') }}</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="col-md-12">{{ trans('app.token_expiration_date') }} <span
                                class="required"> * </span>
                        <small>
                            <i>{{ trans('app.date_until_which_the_what_can_be_signed', ["what"    =>  strtolower(trans('app.contract'))]) }}</i>
                        </small>
                    </label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   placeholder="YYYY-MM-DD" name="expiry_date"
                                   value="{{ date('Y-m-d', strtotime("+" . Session::get('app_settings')->default_days_contracts_to_expire . " days")) }}"
                                   required>
                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
    </div>
</form>

<script type="text/javascript">

    $(".profile_customer_search").on("change", function (e) {

        var profile_id = $(this).find("option:selected").val();

        $('.reload').show();
    });

    $(document).ready(function () {
        $(".profile_customer_search").select2({
            ajax: {
                url: '{{ url(Session::get('guard') . '/ajaxdata/profile_customer_user_search') }}',
                dataType: 'json',
                delay: 2000,
                processResults: function (data) {
//                    console.log(data);
                    $.each(data, function (index, value) {
                        data[index].id = data[index].slug;
                    });
                    return {
                        results: data
                    };
                },
                cache: false
            },
            minimumInputLength: 3
        });
    });

</script>