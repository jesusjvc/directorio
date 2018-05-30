<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.set_tax_rate_default_for_the_following_countries') }} @if(isset($profile))<br><small> {{ $profile->business_name }} </small> @endif </h4>
</div>

@php
    if(isset($profile)):
    $modifylink = $profile->id . '/profile_';
    else:
    $modifylink = null;
    endif;
@endphp

<form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations/'.$configuration->id.'/assign') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations') }}">
    <div class="modal-body">
        <p>
            {{ trans('app.this_tax_rate_will_be_set_as_the_default_tax_rate_for_customers_who_have_a_billing_address_in_the_countries_selected_below_however_this_is_a_default_only_and_tax_rates_can_be_set_at_the_time_of_creating_a_financial_document') }}
        </p>
        <hr>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="form-group">
                @foreach($countries as $country)
                    <div class="col-md-6">
                        <div class="checkbox-list">
                            <label style="font-weight:normal;">
                                <input type="checkbox" value="{{ $country->id }}" name="id[]"
                                       @if(in_array($country->id, $relation)) checked @endif>
                                {{ $country->country }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>