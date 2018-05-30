<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.edit_call_notification_phrase') }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id) }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.go_back') }}
                            </span>
                        </a>
                    </div>
                </div>
                <form role="form" method="POST"
                      action="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id . '/edit/' . $notification_message->id) }}"
                      reloadurl="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id) }}"
                      id="idForm">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="panel-body">
                        <p class="text-muted">
                            {{ trans('app.changes_made_to_this_notification_record_will_only_apply_for_newly_created_appointments') }}
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        <input id="sendbydefault" type="checkbox" value="1" name="bydefault"
                                               @if($notification_message->bydefault == 1) checked @endif>
                                        <label for="sendbydefault">
                                            {{ trans('app.call_by_default') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.send_message_x_days_before_appointment') }} <span
                                                class="required"> * </span></label>
                                    <small><i>{{ trans('app.the_number_0_represents_the_day_of_the_appointment') }}</i>
                                    </small>
                                    <input type="number" min="0" value="{{ $notification_message->days_before }}"
                                           name="days_before" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.text_to_speech_phrase') }} <span
                                                class="required"> * </span></label>
                                    <textarea rows="7" maxlength="1000" name="notification_message" class="form-control"
                                              required>{{ $notification_message->notification_message }}</textarea>
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