<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            {!! trans('app.update_custom_invoice_field_fieldname', ["fieldname" => "<i>" . $field->field_name . "</i>"]) !!}
            <br>
            <small>
                {{ $profile->business_name }}
            </small>
        </h4>
    </div>
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/custom_invoice_fields/' . $field->id . '/edit') }}" id="idForm"
          reloadiv="reload" reloadurl="{{ url(Session::get('guard') . '/custom_invoice_fields') }}">
        <div class="modal-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.enter_a_name_for_this_field') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="30" name="field_name" value="{{ $field->field_name }}"
                               class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.selected_a_datatype_for_this_field') }} <span class="required"> * </span></label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="text" populate="text" @if($field->type == 'text') selected @endif>{{ trans('app.text') }}</option>
                            <option value="number" populate="number" @if($field->type == 'number') selected @endif>{{ trans('app.number') }}</option>
                            <option value="menu" populate="menu" @if($field->type == 'menu') selected @endif>{{ trans('app.menu') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.should_this_field_be_presented_on_pdf_and_print_versions_of_documenttypes', ["documenttypes" => strtolower(trans('app.invoices'))]) }}
                            <span class="required"> * </span></label>
                        <div>
                            <input type="radio" name="show_on_export" id="show_on_export_yes" value="yes" @if($field->show_on_export == 'yes') checked @endif>
                            <label for="show_on_export_yes">{{ trans('app.yes') }}</label>
                        </div>
                        <div>
                            <input type="radio" name="show_on_export" id="show_on_export_no" value="no" @if($field->show_on_export == 'no') checked @endif> <label
                                    for="show_on_export_no">{{ trans('app.no') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.should_this_field_be_a_required_field') }} <span
                                    class="required"> * </span></label>
                        <div>
                            <input type="radio" name="required" id="required_yes" value="yes" @if($field->required == 'yes') checked @endif> <label
                                    for="required_yes">{{ trans('app.yes') }}</label>
                        </div>
                        <div>
                            <input type="radio" name="required" id="required_no" value="no" @if($field->required == 'no') checked @endif> <label
                                    for="required_no">{{ trans('app.no') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="showmenuoptions" @if($field->type != 'menu') style="display:none" @endif>
                    <div class="form-group">
                        <label>{{ trans('app.dropdown_menu_options') }} <span class="required"> * </span></label>
                        <input type="text" name="menu_options" value="{{ $field->menu_options }}"
                               placeholder="{{ trans('app.options_should_be_comma_separated') }}"
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#type").on("change", function () {
            $("#showmenuoptions").hide();
            var typevalue = $("#type").val();
            if (typevalue == 'menu') {
                $("#showmenuoptions").show();
            }
        })
    });
</script>