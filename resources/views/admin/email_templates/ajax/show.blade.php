@php
    $explode = explode("|",$instance->static_variable_relation->relation);
    $parent = $explode[0];
    $child = $explode[1];
    $vars = explode("|",$instance->static_variable_relation->available_variables);
@endphp
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/email_templates/' . $instance->id) }}" id="idForm">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="row">
        <div class="col-md-12">
            <h3 class="subnav">{{ ucwords(str_replace("_", " ", $child . ' ' . $parent)) }}</h3>
        </div>
        @if($parent == 'custom')
            <input type="hidden" value="custom" name="subject">
        @endif
        @if(($parent != 'application') && ($parent != 'verification') && ($parent != 'custom') && ($parent != 'contracts'))
            <div class="col-md-12">
                <div class="form-group">
                    <label>
                        <input name="enabled" value="1" type="checkbox"
                               @if($instance->enabled == 1) checked @endif> {{ trans('app.enable_this_email') }}
                    </label>
                </div>
            </div>
        @else
            <input type="hidden" name="enabled" value="1">
        @endif
        @if(($parent != 'custom') && ($child != 'reminder'))
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ trans('app.email_subject') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="150" name="subject" value="{{ $instance->subject }}"
                           class="form-control"
                           required>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ trans('app.email_body') }} <span class="required"> * </span></label>
                <textarea class="form-control" name="body"
                          rows="18">{!! $instance->body !!}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="subnav">{{ trans('app.usable_variables') }}</h3>
        </div>
        <div class="col-md-12">
            <div>
                <pre class="variableblock">@foreach($vars as $usable)<span class="badge badge-info lowercase nobold">{{ "&#123;&#123;" . $usable . "&#125;&#125;" }}</span> @endforeach </pre>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <hr>
            <button class="btn btn-primary scroll">{{ trans('app.save') }}</button>
        </div>
    </div>
</form>
@if (Request::ajax())
    <script type="text/javascript">
        $(document).ready(function () {
            $(".scroll").click(function () {
                $('html,body').scrollTop(0);
            });
            $('html,body').scrollTop(0);
        });
    </script>
@endif
<script src="{{ url('/assets/plugins/bower_components/trumbowyg/trumbowyg.js') }}"></script>
@include('global.includes.editor')