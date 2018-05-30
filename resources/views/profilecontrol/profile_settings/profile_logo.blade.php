<div class="row">
    <div class="col-md-12">
        {!! trans('descriptions.logo_is_optional_on_edit') !!}
        <hr>
        <div class="col-md-3">
            <div style="display: table; width: 100%; min-height: 180px;">
                <div style="display: table-cell; text-align: center; vertical-align: middle;">
                    <img src="{{ $logo }}" width="100%">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <input type="file" id="input-file-now" name="file" class="dropify"/>
            </div>
        </div>
    </div>
</div>