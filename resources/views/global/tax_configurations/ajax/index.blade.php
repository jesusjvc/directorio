@php
if(Session::get('guard') != 'profilecontrol'):
    if(isset($profile)):
    $modifylink = $profile->id . '/profile_';
    else:
    $modifylink = null;
    endif;
else:
$modifylink = null;
endif;
@endphp
<div class="reload">
    <div class="panel-body">
        @if($configurations->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.title') }}
                        </th>
                        <th class="text-center">
                            {{ trans('app.percentage') }}
                        </th>
                        <th>{{ trans('app.default_for') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($configurations as $configuration)
                        <tr>
                            <td>
                                {{ $configuration->title }}
                            </td>
                            <td class="text-center">{{ $configuration->percentage }}%
                            </td>
                            <td>
                                @if($configuration->static_countries->count() > 0)
                                    {{ $configuration->static_countries->count() }} {{ trans_choice('app.country',$configuration->static_countries->count()) }}
                                @endif
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                        data-remote="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations/'.$configuration->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-danger btn-xs postconfirm"
                                        data-title="{{ trans('app.delete_tax_rate') }}"
                                        data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_tax_rate') }} <i>{{ $configuration->title }}</i>"
                                        data-reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations') }}"
                                        data-posturl="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations/'.$configuration->id) }}">{{ trans('app.delete') }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-success btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                        data-remote="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations/'.$configuration->id.'/assign') }}">{{ trans('app.link_countries') }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{ trans('app.no_data_found') }}
        @endif
    </div>
</div>