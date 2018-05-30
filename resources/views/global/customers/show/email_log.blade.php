<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.email_log') }}
                    <i>
                        <small>{{ trans('app.maximum_howmany_results',["howmany" => Session::get('app_settings')->limit_log_results]) }}</small>
                    </i>
                    <div class="pull-right">
                        <button id="print" class="btn btn-default btn-outline" type="button"><span><i
                                        class="fa fa-print"></i> {{ trans('app.print') }}</span></button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive printableArea">
                        @php
                            $i = 1;
                        @endphp
                        @foreach($records as $record)
                            <table class="table" style="page-break-after: always;">
                                <tbody>
                                <thead>
                                <tr>
                                    <th class="text-left" style="text-transform: uppercase;">
                                        [{{ $i }}
                                        ] {{ trans('app.direction_email_sent_on_sent_date_by_byuser_to_to_from_from',["direction" => $record->email_log->direction, "sent_date" => $record->email_log->created_at, "byuser" => ucwords($record->byuser->prefix . ' ' . $record->byuser->firstname . ' ' . $record->byuser->lastname), "to" => $record->email_log->email_to, "from" => $record->email_log->email_from]) }}
                                    </th>
                                </tr>
                                </thead>
                                <tr>
                                    <td class="text-left">
                                        <strong>{{ trans('app.subject') }}</strong>: {{ $record->email_log->email_subject }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        {!! $record->email_log->email_message !!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
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