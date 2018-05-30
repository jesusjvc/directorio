@php
    if($contact != null):
    $contactid = $contact->id;
    $contact = $contact->contact_number;
    else:
        $contact = $user->mobile_no;
        $contactid = null;
    endif;
@endphp
@php
    if($class == 'ProfessionalsController'):
    $section = 'professionals';
    elseif($class == 'ReceptionsController'):
    $section = 'receptions';
    else:
    $section = 'users';
    endif;
@endphp
<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $section . '/' . $user->id . '/send_sms/' . $contactid) }}" id="idForm"
          reloadurl="{{ url(Session::get('guard') . '/' . $section) }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.send_a_sms_to_user_names',["user_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}
                        <br>
                        <small>+{{ $contact }}</small>
                        <div class="pull-right">
                            <a href="{{ url(Session::get('guard') . '/' . $section) }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-success">
                                {{ trans('app.cancel_and_go_back') }}
                            </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.sms_body') }} <span class="required"> * </span></label>
                                    <textarea class="form-control" id="textarea" name="message" maxlength="480"
                                              rows="10">{{ trans('app.dear_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname . ',')]) }}</textarea>
                                    <div id="smsbox"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <hr>
                                <button class="btn btn-primary">{{ trans('app.send') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@include('global.includes.smsbox')