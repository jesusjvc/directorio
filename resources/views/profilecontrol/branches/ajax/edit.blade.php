@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ $profile->business_name }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ url(Session::get('guard') . '/branches/' . $branch->id) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.edit_branch_information_branchname', ["branchname" => $branch->branch_name]) }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/branches') }}"
                           class="fetchajaxpage">
                                    <span class="btn btn-xs btn-primary">
                                        {{ trans('app.go_back') }}
                                    </span>
                        </a>
                    </div>
                </div>
                <script type="text/javascript">
                    function updateFields(newLat, newLng) {
//                        $.get(
//                            "/",
//                            {'newLat': newLat, 'newLng': newLng, 'var1': 'value1'}
//                        )
//                            .done(function (data) {
//                                alert("Database updated");
//                            });

                        $('#latitude').val(newLat);
                        $('#longitude').val(newLng);

                        var latlng = {lat: parseFloat(newLat), lng: parseFloat(newLng)};

                        reverseGeocode(latlng, function (status, result, mark) {
                            if (status == 200) {
                                $('#map_address').val(result);
                            }
                        }, this);
                    }
                    function clearFields() {
                        $('#latitude').val('');
                        $('#longitude').val('');
                    }
                </script>
                {!! $map['js'] !!}
                <div class="panel-body">
                    <h4>{{ trans('app.branch_information') }}</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ trans('app.branch_name') }} <span
                                            class="required"> * </span></label>
                                <input type="text" maxlength="50" name="branch_name" value="{{ $branch->branch_name }}"
                                       class="form-control"
                                       required>
                            </div>
                        </div>
                    </div>
                    <h4>{{ trans('app.business_hours') }}</h4>
                    <p>
                        {{ trans('app.for_days_closed_remove_the_time_value') }}
                    </p>
                    <div class="row">
                        @foreach($businesshours as $key => $value)
                            <div class="col-lg-3 col-md-6 col-xs-12">
                                <label class="m-t-15">{{ trans('app.' . strtolower($key)) }}</label>
                                <div class="input-group {{ $key }}" data-placement="bottom" data-align="top"
                                     data-autoclose="true">
                                    <input type="text" class="form-control" value="{{ $value }}"
                                           name="business_hours[{{ $key }}]">
                                    <span class="input-group-addon"> <span
                                                class="glyphicon glyphicon-time"></span> </span></div>
                            </div>
                        @endforeach
                    </div>
                    <h4>{{ trans('app.facilities') }}</h4>
                    <p>
                        {{ trans('app.enter_the_branch_facilities_as_a_comma_separated_array') }}
                    </p>
                    <div class="row">
                            <div class="col-md-12">
                                <label class="m-t-15">{{ trans('app.branch_facilities') }}</label>
                                <div class="tags-default">
                                    <input type="text" name="facilities" value="{{ $branch->facilities }}" data-role="tagsinput" placeholder="{{ trans('app.eg_coffee_aircon') }}"/>
                                </div>
                            </div>
                    </div>
                    <h4 class="m-t-30">{{ trans('app.geo_location') }}</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="search" value="{{ $branch->map_address }}" id="myPlaceTextBox"
                                       class="form-control"
                                       placeholder="{{ trans('app.enter_the_branch_address_to_start_searching') }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('app.latitude') }} <span
                                            class="required"> * </span></label>
                                <input type="text" maxlength="50" name="latitude" id="latitude" value="{{ $branch->latitude }}"
                                       class="form-control"
                                       required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('app.longitude') }} <span
                                            class="required"> * </span></label>
                                <input type="text" maxlength="50" name="longitude" id="longitude" value="{{ $branch->longitude }}"
                                       class="form-control"
                                       required readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ trans('app.formatted_address') }} <span
                                            class="required"> * </span></label>
                                <input type="text" maxlength="150" name="map_address" id="map_address" value="{{ $branch->map_address }}"
                                       class="form-control"
                                       required readonly>
                            </div>
                        </div>
                    </div>
                    <h4>{{ trans('app.use_the_location_indicator_below_and_drag_it_to_the_exact_location') }}</h4>
                    <div id="topCenterControl"
                         style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        {{ Session::get('profile_settings')->business_name }} / {{ trans('app.register_a_new_branch') }}
                    </div>
                    {!! $map['html'] !!}
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-primary">{{ trans('app.save') }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@push('head')
<link href="{{ url('assets') }}/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<link href="{{ url('assets') }}/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    @foreach($businesshours as $key => $value)
    $(".{{ $key }}").clockpicker({
        donetext: "{{ trans('app.done') }}",

    })
        .find('input').change(function () {
        console.log(this.value);
    });
    @endforeach
</script>
@endpush