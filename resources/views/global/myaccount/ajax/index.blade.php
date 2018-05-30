<div class="{{ $sectiontoreload }}">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/myaccount') }}" id="idForm"
          reloadiv="{{ $sectiontoreload }}" reloadurl="{{ url(Session::get('guard') . '/myaccount') }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="panel-body">
            @if(Session::get('guard') != 'customer')
            <div class="col-md-2">
                <div align="center">
                    <img src="{{ $avatar }}" class="img-circle img-responsive"
                         style="padding-top:20px; padding-bottom:20px;" alt="">
                    <h3 class="avatar">{{ Auth::guard(Session::get('guard'))->user()->firstname }} {{ Auth::guard(Session::get('guard'))->user()->lastname }}</h3>
                </div>
            </div>
            @endif
            <div @if(Session::get('guard') != 'customer') class="col-md-9 col-md-offset-1" @else class="col-md-12" @endif>
                <div class="form-group">
                    <label>{{ trans('app.prefix') }} <span class="required"> * </span></label>
                    <select class="form-control" name="prefix" required>
                        @foreach ($prefixes as $prefix)
                            <option value="{{ $prefix->prefix }}"
                                    @if($prefix->prefix == Auth::guard(Session::get('guard'))->user()->prefix) selected @endif>{{ trans('app.'.$prefix->prefix) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ trans('app.firstname') }}
                        <span
                                class="required"> * </span></label>
                    <input type="text" maxlength="100" name="firstname"
                           value="{{ Auth::guard(Session::get('guard'))->user()->firstname }}"
                           class="form-control"
                           required/>
                </div>
                <div class="form-group">
                    <label class="control-label">{{
                                                        trans('app.lastname') }} <span
                                class="required"> * </span></label>
                    <input type="text" maxlength="100" name="lastname"
                           value="{{ Auth::guard(Session::get('guard'))->user()->lastname }}"
                           class="form-control"
                           required/>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ trans('app.email_address')
                                                        }} <span class="required"> * </span></label>
                    <input type="email" maxlength="100" name="email"
                           value="{{ Auth::guard(Session::get('guard'))->user()->email }}"
                           class="form-control"
                           required/>
                </div>
                <div class="form-group">
                    <label class="control-label">{{
                                                        trans('app.mobile_number') }} <span
                                class="required"> * </span></label>
                    <div class="input-group"><span class="input-group-addon">+</span>
                        <input type="text" maxlength="100" name="mobile_no"
                               value="{{ Auth::guard(Session::get('guard'))->user()->mobile_no }}"
                               class="form-control"
                               required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-info" type="submit"> {{
                                                        trans('app.save') }}
            </button>
        </div>
    </form>
</div>