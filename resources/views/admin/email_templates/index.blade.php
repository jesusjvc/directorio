@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.configuration') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.email_templates') }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            @foreach($subMenu as $key => $value)
                                <h3 class="subnav">{{ ucwords(preg_replace('/_/',' ',$key)) }}</h3>
                                <ul class="linelist">
                                    @foreach($value as $instance)
                                        <li>
                                            <a class="fetchajaxpage"
                                               href="{{ url(Session::get('guard') . '/email_templates/' . $instance['id']) }}">{{ ucwords($instance['link']) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                        <div class="col-md-8 col-md-offset-1">
                            <div class="reload">
                                @include(Session::get('guard') . '.email_templates.ajax.index')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
@endpush