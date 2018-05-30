@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.searching_for_term', ["term" => $term]) }}
@endsection
{{--@if(count($professionals) == 0)--}}
@section('mainsearch')
    @include('frontend.index.mainsearch')
@endsection
{{--@endif--}}
@section('content')
    <script type="text/javascript">
        function updateFields(newLat, newLng) {

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
    <div class="row bg-title">
        <div class="col-md-12">
            @php
                $theurl = URL::current();
                $theurl = explode('/', $theurl);
            @endphp
            @if(in_array('filter',$theurl))
                <h4 class="page-title"
                    @if(count($professionals) == 0) class="text-center" @endif>{!! trans_choice('app.x_provider_found_while_searching_for_term_in_a_distance_radius', count($professionals), ["x" => count($professionals), "term" => "<span style='background-color:#FFFDCB;'>".$term."</span>", "distance" => "<span style='background-color:#FFFDCB;'>". $cookie['radius'] . ' ' . $cookie['measurement'] ."</span>"]) !!}</h3>
                    @else
                        <h4 class="page-title"
                            @if(count($professionals) == 0) class="text-center" @endif>{!! trans_choice('app.x_provider_found_while_searching_for_term', count($professionals), ["x" => count($professionals), "term" => "<span style='background-color:#FFFDCB;'>".$term."</highlight>"]) !!}</h3>
            @endif
        </div>
    </div>
    <div style="margin-top:30px;margin-bottom:30px;">
        @if((count($professionals) > 0) || (Request::get('radius')))
            <div class="white-box">

                <form role="form" method="POST" action="{{ url('/search?q=' . Request::get('q')) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="latitude" @if($cookie != null) value="{{ $cookie['lat'] }}"
                           @endif id="latitude">
                    <input type="hidden" name="longitude" @if($cookie != null) value="{{ $cookie['lng'] }}"
                           @endif id="longitude">
                        <div class="row">
                            <div class="col-md-12">
                                @if(!Request::get('radius'))
                                <div class="text-center">
                                    <div class="btn btn-danger btn-xs">{{ trans('app.search_filter_not_applied') }}</div>
                                </div>
                                @endif
                                <p>{{ trans('app.enter_your_address_or_city_and_country_here_to_filter_results_nearby_you') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="locationfilter"
                                           class="form-control m-b-10"
                                           @if($cookie != null)
                                           value="{{ $cookie['address'] }}"
                                           @endif
                                           autocomplete="off"
                                           placeholder="{{ trans('app.enter_your_location') }}"
                                           id="myPlaceTextBox" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="locationradius"
                                               class="form-control m-b-10"
                                               placeholder="{{ trans('app.search_radius') }}"
                                               @if($cookie != null)
                                               value="{{ $cookie['radius'] }}"
                                               @else
                                               value="100"
                                               @endif
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <select name="distancemeasurement" class="form-control ">
                                        <option value="km"
                                                @if(($cookie != null) && ($cookie['measurement'] == 'km')) selected @endif>{{trans('app.km')}}</option>
                                        <option value="mi"
                                                @if(($cookie != null) && ($cookie['measurement'] == 'mi')) selected @endif>{{trans('app.mi')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary btn-block"
                                        type="submit">{{ trans('app.filter') }}
                                </button>
                            </div>
                        </div>
                        <div style="display:none;">
                            {!! $map['html'] !!}
                        </div>
                </form>
            </div>
    </div>
    @endif

    @if(count($professionals) > 0)
        <div class="row">
            @foreach($professionals as $professional)
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="b-all" style="margin-bottom:15px;">
                        <div class="">
                            <div class="ribbon ribbon-info"
                                 title="{{ $professional->featurecategories }}">{{ $professional->featurecategories_summary }}</div>
                            <img class="img-responsive" alt="user" src="{{ $professional->avatarlist }}">
                            <div class="text-center listing-box">
                                <div class="title">{{ ucwords($professional->firstname . ' ' . $professional->lastname) }}</div>
                                <div class="rating">
                                    {!! CustomHelper::htmlRating($professional->score) !!}
                                </div>
                                <div class="description">
                                    {{ str_limit(CustomHelper::plaintext($professional->professional_profile->description),200) }}
                                </div>
                                <div class="descriptionlocations">
                                    @php
                                        if($professional->agenda_static != null):
                                            $branches = $professional->agenda_static->branches_static;
                                        else:
                                            $branches = $professional->agenda->branches;
                                        endif;
                                    @endphp
                                    @if($professional->agenda_static != null)
                                        @foreach($branches as $branch)
                                            <div>
                                                <strong>
                                                    <i class="fa fa-map-marker"></i>
                                                    {{ str_limit($branch->branch_name,22) }}
                                                    @if((Request::get('lat') != null) && (Request::get('lng') != null))
                                                    &cong; {{ number_format($branch->distance,1) }} @if(Request::get('unit') != null) {{ trans('app.' . Request::get('unit')) }} @endif
                                                    @endif
                                                </strong>
                                            </div>
                                        @endforeach
                                    @else
                                        <strong>
                                            <i class="fa fa-map-marker"></i>
                                            {{ count($professional->agenda->branches) }} {{ trans_choice('app.choice_location', count($professional->agenda->branches)) }}
                                        </strong>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <a href="{{ url('/' . str_slug(trim($professional->firstname) . ' ' . trim($professional->lastname)) . '/' . $professional->agenda->sharecode . '.html') }}"
                                       class="btn btn-info" style="width:100%">
                                        {{ trans('app.view_profile') }}
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
@push('head')
@endpush
@push('javascript')
@if($map != null)
    {!! $map['js'] !!}
@endif
@endpush