@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.rate_my_service') }}
@endsection
@section('content')
    @if(Auth::guard('customer')->user() == null)
        <div style="padding:50px;"></div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div style="width: 80%; margin:0 10%;">
                <div class="white-box">
                    <h3 class="box-title">{{ trans('app.rate_my_service') }}</h3>
                    {!! trans('app.by_rating_the_service_i_have_provided_to_you_at_branch_on_date_you_will_help_me_in_building_a_solid_track_record_on_the_systemname_portal_please_complete_the_form_below_and_click_on_the_rate_me_button_thank_you_providername',
                    [
                    "branch"  =>  $rating->appointment->branch->branch_name,
                    "date"  =>  CustomHelper::dateTimeLong($rating->appointment->date),
                    "systemname"  =>  Session::get('profile_settings')->business_name,
                    "providername"  =>  ucwords(trans('app.' . $rating->appointment->agenda->user->prefix) . ' ' . $rating->appointment->agenda->user->firstname . ' ' . $rating->appointment->agenda->user->lastname),
                    ]
                    ) !!}

                    <hr>

                    <form method="POST" action="{{ url('/rateme/' . $rating->token) }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-2 text-left">
                                {{ trans('app.attention_to_detail') }}:
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="attention" value="5" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.very_efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="attention" value="4" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="attention" value="3" checked="checked" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="attention" value="2" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.not_so_good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="attention" value="1" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.poor') }}
                                                        </span>
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 text-left">
                                {{ trans('app.on_time') }}:
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="on_time" value="5" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.very_efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="on_time" value="4" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="on_time" value="3" checked="checked" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="on_time" value="2" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.not_so_good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="on_time" value="1" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.poor') }}
                                                        </span>
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 text-left">
                                {{ trans('app.price') }}:
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="price" value="5" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.very_efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="price" value="4" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="price" value="3" checked="checked" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="price" value="2" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.not_so_good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="price" value="1" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.poor') }}
                                                        </span>
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 text-left">
                                {{ trans('app.facilities') }}:
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="facilities" value="5" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.very_efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="facilities" value="4" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.efficient') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="facilities" value="3" checked="checked" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="facilities" value="2" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.not_so_good') }}
                                                        </span>
                                </label>
                            </div>
                            <div class="col-md-2 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="facilities" value="1" required>
                                    <span style="margin:20px; 0">
                                                        {{ trans('app.poor') }}
                                                        </span>
                                </label>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <hr>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ trans('app.rate_me') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection @push('head') @endpush @push('javascript') @endpush