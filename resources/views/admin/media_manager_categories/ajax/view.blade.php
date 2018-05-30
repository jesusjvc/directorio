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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>

                            </th>
                            <th class="text-center">
                                <span class="oneline">{{ trans('app.file_type') }}</span>
                            </th>
                            <th>
                                <span class="oneline">{{ trans('app.file_name') }}</span>
                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                            <th class="text-left">
                                <span class="oneline">
                                    {{ trans('app.email_attachment') }}
                                </span>
                            </th>
                            <th>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td class="text-center">
                                    @if((pathinfo($file['fullpath'], PATHINFO_EXTENSION) == 'jpg') || (pathinfo($file['fullpath'], PATHINFO_EXTENSION) == 'png'))
                                        <div class="icon"><img class="img img-rounded"
                                                               src="{{ substr(Storage::url($file['fullpath']),0,-strlen($file['filename'])) . 'thumbs/' . $file['filename'] }}">
                                        </div>
                                    @else
                                        <div class="icon"><i
                                                    class="fa {{ CustomHelper::iconForFile($file['ext']) }}"></i></div>
                                        <div class="filemanagerext">{{ strtoupper($file['ext']) }}</div>
                                        <div class="filemanagerbreak"></div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ strtoupper($file['ext']) }}
                                </td>
                                <td>
                                    <span class="oneline">{{ $file['filename'] }}</span>
                                </td>
                                <td>
                                    <a href="{{ Storage::url($file['fullpath']) }}"
                                       target="_blank">
                                        <span class="btn btn-xs btn-primary">{{ trans('app.open') }}</span>
                                    </a>
                                </td>
                                <td>
                                    <a class="postconfirm hand"
                                       data-title="{{ trans('app.delete_file') }}"
                                       title="{{ trans('app.delete_file') }}"
                                       data-description="{{  trans('app.are_you_sure_you_want_to_delete_this_file_note_that_if_this_file_is_used_in_any_static_attachments_such_as_in_sending_emails_the_file_will_not_be_attached') }}"
                                       data-reloaddiv="reload"
                                       data-reloadurl="{{ URL::current() }}"
                                       data-posturl="{{ url(Session::get('guard') . '/media_manager/delete/' . preg_replace('/\//','_',$file['fullpath'])) }}">
                                        <span class="btn btn-xs btn-danger">{{ trans('app.delete') }}</span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                          data-remote="{{  url(Session::get('guard') . '/media_manager/link_email_attachment/' . preg_replace('/\//','|',$file['fullpath'])) }}">
                                        {{ trans('app.link') }}
                                    </span>
                                </td>
                                <td class="text-left">
                                    @if(count($file['email_attachments']) > 0)
                                        @foreach($file['email_attachments'] as $attachment)
                                            <a class="postconfirm hand"
                                               data-title="{{ trans('app.remove_as_attachment') }}"
                                               title="{{ trans('app.remove_as_attachment') }}"
                                               data-description="{!! trans('app.are_you_sure_you_want_to_remove_this_frile_from_the_email_attachment_email', ["email" => "<strong>" . CustomHelper::reverseUscore(preg_replace('/\|/',': ',$attachment->email_template->static_variable_relation->relation)) . "</strong>"]) !!}"
                                               data-reloaddiv="reload"
                                               data-reloadurl="{{ URL::current() }}"
                                               data-posturl="{{ url(Session::get('guard') . '/media_manager/revoke_attachment/' . $attachment->id) }}">
                                                <span class="btn btn-xs btn-danger m-b-5">{{ trans('app.revoke') }} <i>{{ CustomHelper::reverseUscore(preg_replace('/\|/',': ',$attachment->email_template->static_variable_relation->relation)) }}</i></span>
                                            </a>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <form action="{{ url(Session::get('guard') . '/media_manager/' . preg_replace('/\//','_',$path)) }}"
                  class="dropzone">
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