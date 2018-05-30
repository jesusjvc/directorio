<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.create_a_new_scheduled_call_notification_phrase_for_branchname', ["branchname"   =>  $branch->branch_name]) }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id) }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.go_back') }}
                            </span>
                        </a>
                    </div>
                </div>
                <form role="form" method="POST" action="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id) }}"
                      reloadurl="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id) }}"
                      id="idForm">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted m-b-15 font-13 text-left">
                                    {{ trans('app.example') }}
                                    <br>
                                    <code>
                                        Dear &#123;&#123;customer_prefix&#125;&#125; &#123;&#123;customer_firstname&#125;&#125; &#123;&#123;customer_lastname&#125;&#125;. This is a friendly reminder
                                        about your appointment tomorrow at &#123;&#123;provider&#125;&#125; on &#123;&#123;appointment_date&#125;&#125;
                                    </code>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        <input id="sendbydefault" type="checkbox" name="bydefault" value="1">
                                        <label for="sendbydefault">
                                            {{ trans('app.call_by_default') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.dispatch_call_reminder_x_days_before_appointment') }} <span
                                                class="required"> * </span></label>
                                    <small><i>{{ trans('app.the_number_0_represents_the_day_of_the_appointment') }}</i></small>
                                    <input type="number" min="0" value="0" name="days_before" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.text_to_speech_phrase') }} <span class="required"> * </span></label>
                                    <textarea rows="7" maxlength="1000" name="notification_message" class="form-control"
                                              required></textarea>
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