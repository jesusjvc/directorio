<form action="{{ url('/search') }}" method="GET" id="top-search">
    <div class="searchbox" style="background-image: url('{{ url('images/mainsearch/general_a.jpg') }}');">
    <div class="title">
                <span class="highlight">
                    {{ trans('app.what_are_you_looking_for') }}
                </span>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="search-form">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input name="q" type="text" class="form-control search" id="what" autocomplete="off"
                                   placeholder="{{ trans('app.what_are_you_looking_for') }} {{ trans('app.eg_eye_specialist_masseuse_lawyer') }}">
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-3-->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info"
                                style="width:100%;">{{ trans('app.search') }}</button>
                    </div>
                    <!--end col-md-3-->
                </div>
                @if(count($randomcategories) > 0)
                    <div class="row indexcategories">
                        <div class="col-md-12">
                            @foreach($randomcategories as $indexcategory)
                                <a href="{{ url('/search?q=' . strtolower($indexcategory->title)) }}">
                                    <span class="indexcategory">{{ $indexcategory->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</form>