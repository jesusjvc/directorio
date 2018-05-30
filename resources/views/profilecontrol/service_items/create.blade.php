<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.register_a_new_service_item') }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/service_items') }}" id="idForm">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.select_a_category') }} <span class="required"> * </span></label>
                <select class="form-control" name="service_category_id" id="service_category_id" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($service_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.select_a_service_module') }} <span class="required"> * </span></label>
                <select class="form-control" name="static_service_module_id" id="static_service_module_id">
                    <option value="" populate="{{ trans('app.units') }}">{{ trans('app.general_item') }}</option>
                    @foreach ($service_modules as $module)
                        <option value="{{ $module->id }}"
                                populate="{{ trans('app.' . $module->billing_units) }}">{{ trans('app.' . $module->module) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.item_name') }} <span class="required"> * </span></label>
                <input type="text" maxlength="100" name="name" class="form-control" required>
            </div>
            <div class="hidehere">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>{{ trans('app.total_units') }} <span class="required"> * </span></label>
                            <input type="number" min="1" name="units" value="1" class="form-control"
                                   placeholder="{{ trans('app.eg_30_for_30_minutes') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div id="additionalinfodiv">
                            <label>{{ trans('app.units') }} <span class="required"> * </span></label>
                            <input type="text" id="populateunits" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.amount') }} <span class="required"> * </span><small>{{ trans('app.tax_exclusive') }}</small></label>
                <div class="input-group">
                    <input type="number" min="0" step="0.01" placeholder="0.00" name="amount" class="form-control"
                           required>
                    <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $("#populateunits").val($("#static_service_module_id").find("option:selected").attr("populate"));
    });
    $(document).ready(function () {
        $("#static_service_module_id").on("change", function () {
            $("#populateunits").val($(this).find("option:selected").attr("populate"));
        });
        $("#static_service_module_id").on("change", function () {
            if ($("#static_service_module_id").val() != "0") {
                $(".hidehere").show();
            } else {
                $(".hidehere").hide();
            }
        });
        if ($("#static_service_module_id").val() != "0") {
            $(".hidehere").show();
        } else {
            $(".hidehere").hide();
        }
    });
</script>