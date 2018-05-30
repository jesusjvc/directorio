<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.timezone') }} <span class="required"> * </span></label>
            <select name="timezone" class="form-control select2" style="width:100%" required>
                @foreach ($timezones as $timezone)
                    <option value="{{ $timezone }}" @if($profile->timezone == $timezone) selected @endif>{{ str_replace("_", " ", $timezone) }}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.duration_to_show_flash_messages') }} <span class="required"> * </span></label>
            <input type="number" min="0" step="1" name="duration_to_show_flash_messages" value="{{ $profile->duration_to_show_flash_messages }}" class="form-control"
                   required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.paper_size') }} <span class="required"> * </span></label>
            <select class="form-control" name="paper_size" required>
                <option value="A4" @if($profile->paper_size == 'A4') selected @endif>A4
                </option>
                <option value="Letter" @if($profile->paper_size == 'Letter') selected @endif>Letter
                </option>
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>