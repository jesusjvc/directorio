<div class="row">
    @if($path == null)
        <div class="col-md-12">
            <p class="text-center">
                {{ trans('app.select_or_create_a_category_on_the_left_to_start_uploading_files_and_making_use_of_the_media_manager') }}
            </p>
        </div>
    @else
        <div class="col-md-12">
            <h3>
                @if((($files == null) || (count($files) == 0)) && ($hasChild == null))
                    <a class="postconfirm hand"
                       data-title="{{ trans('app.delete_file') }}"
                       title="{{ trans('app.delete_media_category') }}"
                       data-description="{{  trans('app.are_you_sure_you_want_to_delete_the_media_category_categoryname', ["categoryname"   =>  $category->title]) }}"
                       data-reloaddiv="reload"
                       data-reloadurl="{{ url(Session::get('guard') . '/media_manager') }}"
                       data-posturl="{{ url(Session::get('guard') . '/media_manager_categories/delete/' . $category->id) }}">
                        <i class="fa fa-minus-square"></i>
                    </a>
                @endif
                {{ $categoryTitle }} </h3>
        </div>
        <div class="col-md-12">
            @if(($files != null) && (count($files) > 0))
                @foreach($files as $file)
                    <div class="filemanager" style="width:100px;" data-toggle="tooltip" title="{{ $file['filename'] }}">
                        @if(pathinfo($file['fullpath'], PATHINFO_EXTENSION) == 'jpg')
                            <a href="{{ Storage::url($file['fullpath']) }}" class="image-popup-fit-width"
                               target="_blank">
                                <div class="icon"><img
                                            src="{{ substr(Storage::url($file['fullpath']),0,-strlen($file['filename'])) . 'thumbs/' . $file['filename'] }}">
                                </div>

                                <span class="filemanagertitle">{{ substr($file['filename'],0,13) }}</span>
                            </a>
                        @else
                            <a href="{{ Storage::url($file['fullpath']) }}" target="_blank">
                                <div class="icon"><i class="fa {{ CustomHelper::iconForFile($file['ext']) }}"></i></div>
                                <div class="filemanagerext">{{ strtoupper($file['ext']) }}</div>
                                <div class="filemanagerbreak"></div>
                                <span class="filemanagertitle">{{ substr($file['filename'],0,13) }}</span>
                            </a>
                        @endif
                        <a class="postconfirm hand"
                           data-title="{{ trans('app.delete_file') }}"
                           title="{{ trans('app.delete_file') }}"
                           data-description="{{  trans('app.are_you_sure_you_want_to_delete_this_file_note_that_if_this_file_is_used_in_any_static_attachments_such_as_in_sending_emails_the_file_will_not_be_attached') }}"
                           data-reloaddiv="reload"
                           data-reloadurl="{{ URL::current() }}"
                           data-posturl="{{ url(Session::get('guard') . '/media_manager/delete/' . preg_replace('/\//','_',$file['fullpath'])) }}">
                            <code>{{ trans('app.delete') }}</code>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-12">
            <form action="{{ url(Session::get('guard') . '/media_manager/' . preg_replace('/\//','_',$path)) }}" class="dropzone">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <div class="fallback">
                    <input name="file" type="file" multiple/>
                </div>
            </form>
        </div>
    @endif
</div>
<script type="text/javascript">
    $(document).ready(function () {
        if (typeof openGate === 'undefined') {

            openGate = true;
            console.log('openGate == true');

            prepareBeforeAjax('categories', "{{ url(Session::get('guard') . '/media_manager_categories') }}");
            var xhr = doLoad('categories', "{{ url(Session::get('guard') . '/media_manager_categories') }}");

        }
    });
</script>
@if (Request::ajax())
    <script type="text/javascript">
        $(document).ready(function () {
            Dropzone.discover();
        });
    </script>
@endif