<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.create_a_new_appointment_call_notification_phrase_for_branchname', ["branchname"   =>  $branch->branch_name]) }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/appointment_call_notifications/' . $branch->id) }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.go_back') }}
                            </span>
                        </a>
                    </div>
                </div>
                <form role="form" method="POST" action="{{ url(Session::get('guard') . '/appointment_call_notifications/' . $branch->id) }}"
                      reloadurl="{{ url(Session::get('guard') . '/appointment_call_notifications/' . $branch->id) }}"
                      id="idForm">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.text_to_speech_phrase') }} <span class="required"> * </span></label>
                                    <textarea rows="7" maxlength="1000" name="notification_message" class="form-control" required>{{ trans('app.dear') }} &#123;&#123;customer_prefix&#125;&#125; &#123;&#123;customer_firstname&#125;&#125; &#123;&#123;customer_lastname&#125;&#125;</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>{{ trans('app.available_custom_values') }} </label>
                            </div>
                            <div class="col-md-12">
                                @include('global.includes.notification_variables')
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>