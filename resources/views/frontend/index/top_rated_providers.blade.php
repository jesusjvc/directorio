@if(count($professionals) > 0)
    <div class="row">
        <div class="col-md-12">
            <h3>{{ trans('app.featured_providers') }}</h3>
        </div>
    </div>

    <div class="row">
        @foreach($professionals as $professional)
        <div class="col-md-3 col-xs-12 col-sm-6">
            <div class="b-all">
                <div class="">

                    <div class="ribbon ribbon-info" title="{{ $professional->featurecategories }}">{{ $professional->featurecategories_summary }}</div>
                    <img class="img-responsive" alt="user" src="{{ $professional->avatarlist }}">
                    <div class="text-center listing-box">
                        <div class="title">{{ ucwords($professional->firstname . ' ' . $professional->lastname) }}</div>
                        <div class="rating">
                            {!! CustomHelper::htmlRating($professional->score) !!}
                        </div>
                        <div class="description">
                            {{ str_limit(CustomHelper::plaintext($professional->professional_profile->description),120) }}
                        </div>
                        <div class="text-center">
                            <a href="{{ url('/' . str_slug(trim($professional->firstname) . ' ' . trim($professional->lastname)) . '/' . $professional->agenda->sharecode . '.html') }}" class="btn btn-info" style="width:100%">
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