<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.link_email_attachment') }}</h4>
</div>
@php
$storeFilename = preg_replace('/\|/','/',$filename);
$newReturn = explode('|',$filename);
$count = count($newReturn);
$justfilename = array_last($newReturn);
unset($newReturn[$count-1]);
unset($newReturn[0]);
unset($newReturn[1]);
$newReturn = implode('_', $newReturn);
@endphp
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/media_manager/link_email_attachment') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/media_manager/' . $newReturn) }}">
    <input type="hidden" name="full_path" value="{{ $storeFilename }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <p class="text-muted">
                {!! trans('app.please_select_an_email_template_below_to_where_you_want_to_attach_the_file_filename_to_as_an_email_attachment', ["filename" => "<strong>" . $justfilename . "</strong>"]) !!}
            </p>
            <p class="text-muted">
                {!! trans('app.please_mind_about_the_file_size') !!}
            </p>
            <hr>
            <div class="form-group">
                {{--<label>{{ trans('app.email_templates') }} {{ $newReturn }}<span class="required"> * </span></label>--}}
                <select class="form-control" name="email_template_id" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($templates as $key => $templatesarray)
                        <optgroup label="{{ CustomHelper::reverseUscore($key) }}">
                            @if(count($templatesarray) > 0)
                                @foreach ($templatesarray as $template)
                                    <option value="{{ $template->id }}">{{ CustomHelper::reverseUscore($template->cat) }}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>