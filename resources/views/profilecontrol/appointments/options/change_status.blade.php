<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.change_appointment_status') }}</h4>
</div>
<form role="form" method="POST"
      action="{{ url('profilecontrol/appointments/' . $appointment->agenda->id . '/change_status/' . $appointment->id) }}"
      reloadurl="{{ url('profilecontrol/appointments/' . $appointment->agenda->sharecode) }}"
      id="idForm">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="form-body">
            <div class="modal-body">
                <p class="text-muted">
                    {{ trans('app.the_current_status_of_this_appointment_is_status', ["status" => trans('app.' . $appointment->status)]) }}
                    {{ trans('app.you_can_change_the_appointment_status_of_this_appointment_to_any_of_the_following_options') }}
                </p>
                <hr>
                <div class="form-body">
                    @if($appointment->status != 'active')
                        <div class="radio radio-success">
                            <input type="radio" name="status" id="active"
                                   value="active">
                            <label for="active">
                                {{ trans('app.active') }}
                            </label>
                        </div>
                    @endif
                    @if($appointment->status != 'confirmed')
                        <div class="radio radio-success">
                            <input type="radio" name="status" id="confirmed"
                                   value="confirmed">
                            <label for="confirmed">
                                {{ trans('app.confirmed') }}
                            </label>
                        </div>
                    @endif
                        @if($appointment->status != 'attended')
                            <div class="radio radio-success">
                                <input type="radio" name="status" id="attended"
                                       value="attended">
                                <label for="attended">
                                    {{ trans('app.attended') }}
                                </label>
                            </div>
                        @endif
                        @if($appointment->status != 'billed')
                            <div class="radio radio-success">
                                <input type="radio" name="status" id="billed"
                                       value="billed">
                                <label for="billed">
                                    {{ trans('app.billed') }}
                                </label>
                            </div>
                        @endif
                        @if($appointment->status != 'nsu')
                            <div class="radio radio-success">
                                <input type="radio" name="status" id="nsu"
                                       value="nsu">
                                <label for="nsu">
                                    {{ trans('app.nsu') }}
                                </label>
                            </div>
                        @endif

                    <hr>
<div class="rateme">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input id="rateme" name="rateme" type="checkbox" value="1">
                            <label for="rateme"> {{ trans('app.would_you_like_to_send_a_rate_me_email') }} </label>
                        </div>
</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $(".rateme");
            if (inputValue == "attended") {
                targetBox.show();
            } else {
                targetBox.hide();
            }
        });
        if ($('input[type="radio"]').val() == "attended") {
            $(".rateme").show();
        } else {
            $(".rateme").hide();
        }
    });
</script>