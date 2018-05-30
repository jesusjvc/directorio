<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default printableArea">
                <div class="panel-heading">
                    {{ trans('app.system_log') }}:
                    @if($customer != null)
                        {{ trans('app.records_log_of_ofwhat',["ofwhat" => trans('app.customer') . ' ' . ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}
                    @else
                        {{trans('app.no_data_found')}}
                    @endif
                    <i>
                        <small>{{ trans('app.maximum_howmany_results',["howmany" => Session::get('app_settings')->limit_log_results]) }}</small>
                    </i>
                    <div class="pull-right">
                        <button id="print" class="btn btn-default btn-outline" type="button"><span><i
                                        class="fa fa-print"></i> {{ trans('app.print') }}</span></button>
                    </div>
                </div>

                <div class="panel-body">

                    @php
                        $heading = array_except($heading, [
                            'created_at',
                            'note',
                        ]);
                    $i = 1;
                    @endphp
                    @foreach ($records as $record)
                        <div style="page-break-after: always; font-size:12px;">
                            <div class="text-center"
                                 style="font-weight:bold; font-size:15px; clear:left; padding:10px;">
                                [{{ $i }}]
                            </div>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($heading as $key => $value)
                                    <tr>
                                        <th class="text-left" style="white-space: nowrap;" width="100px;">
                                            {{ $value }}
                                        </th>
                                        <td class="text-left" style="white-space: nowrap;">
                                            {{ $record[$key] }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js') }}/jquery.PrintArea.js" type="text/JavaScript"></script>
<script>
    $(document).ready(function () {
        $("#print").click(function () {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {mode: mode, popClose: close};
            $("div.printableArea").printArea(options);
        });
    });
</script>
