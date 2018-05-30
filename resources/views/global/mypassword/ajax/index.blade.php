<div class="{{ $sectiontoreload }}">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/mypassword') }}" id="idForm"
          reloadiv="{{ $sectiontoreload }}" reloadurl="{{ url(Session::get('guard') . '/mypassword') }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">{{ trans('app.current_password') }} <span
                                class="required"> * </span></label>
                    <input type="password" name="current_password"
                           class="form-control" required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ trans('app.new_password') }} <span
                                class="required"> * </span></label>
                    <input type="password" name="password" class="form-control"
                           required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ trans('app.confirm_new_password') }} <span
                                class="required"> * </span></label>
                    <input type="password" name="password_confirmation"
                           class="form-control" required/>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-info" type="submit"> {{
																trans('app.change_password') }}
            </button>
        </div>
    </form>
</div>