<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.email_contract') }}<br>
        <small>{{ $contract->title }}</small>
    </h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/email') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/contracts/template/' . $contract->contract_template->id) }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <label class="col-md-12">{{ trans('app.recipient_search') }} <span
                        class="required"> * </span></label>
            <small><i>{{ trans('app.this_can_be_a_profile_owner_customer_account_or_user_account') }}</i></small>
            <div class="form-group">
                <select name="find_id" class="form-control customer_user_search"
                        required>
                    <option value=""
                            selected>{{ trans('app.search_for_a_recipient') }}</option>
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.optional_custom_message') }}</label>
                <textarea class="form-control" name="message"
                          rows="10"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.send') }}</button>
    </div>
</form>

<script type="text/javascript">

    $(".customer_user_search").on("change", function (e) {

        var profile_id = $(this).find("option:selected").val();

        $('.reload').show();
    });

    $(document).ready(function () {
        $(".customer_user_search").select2({
            ajax: {
                url: '{{ url(Session::get('guard') . '/ajaxdata/customer_user_search') }}',
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