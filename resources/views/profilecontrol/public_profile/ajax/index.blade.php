<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/public_profile') }}"
          id="idForm" reloadiv="reload"
          reloadurl="{{ url(Session::get('guard') . '/public_profile') }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-muted text-uppercase m-t-0 m-b-20">
                        <b>{{ trans('app.public_url') }}</b>
                    </h5>
                    <p class="text-muted">
                        {{ url('/' . str_slug(trim($professional->firstname) . ' ' . trim($professional->lastname)) . '/' . $professional->agenda->sharecode . '.html') }}
                    </p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-muted text-uppercase m-t-0 m-b-20">
                        <b>{{ trans('app.public_description') }}</b>
                    </h5>
                    <p class="text-muted">
                        {{ trans('app.your_public_profile_description_is_displayed_to_the_outside_world_in_the_search_portal_keep_it_short_to_the_point_and_informative') }}
                    </p>
                    <div class="form-group m-b-20">
                                <textarea class="form-control" rows="18"
                                          name="description">@if($professional->professional_profile != null) {{ $professional->professional_profile->description }} @endif
                                </textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-muted text-uppercase m-t-0 m-b-20">
                        <b>{{ trans('app.search_categories') }}</b>
                    </h5>
                    <p class="text-muted">
                        {{ trans('app.search_categories_serves_as_tags_which_helps_a_user_to_find_you_in_the_public_portal_make_sure_that_you_select_all_but_relevant_categories_only') }}
                    </p>
                    <hr>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            @if(count($category->child_categories) > 0)
                                <label>
                                    {{ $category->title }}
                                </label>
                                <ul class="list-unstyled">
                                    @foreach($category->child_categories as $subcategory)
                                        <div class="form-group col-md-3">
                                            <li>
                                <span>
                                <input type="checkbox" name="pivot[]" id="{{ $subcategory->id }}"
                                       value="{{ $subcategory->id }}"
                                       @if($professional->child_categories->contains($subcategory->id)) checked @endif
                                >
                                <label for="{{ $subcategory->id }}">{{ $subcategory->title }}</label>
                                </span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                                <div class="clearfix"></div>
                            @endif
                        @endforeach
                    @else
                        <p>
                            {{ trans('app.important_no_categories_exist_unable_to_select_professions') }}
                        </p>
                        <hr>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-info" type="submit"> {{
                                                        trans('app.save') }}
            </button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".scroll").click(function () {
                $('html,body').scrollTop(0);
            });
            $('html,body').scrollTop(0);
        });
    </script>
    <script src="{{ url('/assets/plugins/bower_components/trumbowyg/trumbowyg.js') }}"></script>
    @include('global.includes.editor')
</div>