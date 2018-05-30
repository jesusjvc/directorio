<script>
    // ajax autoload and update
    function initiateAutoUpdate() {
        ajax_pending_appointments();
        @if (Session::get('app_settings')->disable_sms == 0)
        ajax_inbound_sms_messages();
        @endif
        ajax_read_notifications(); // only on load
        setInterval(ajax_pending_appointments, 600000); // every 600 seconds
        @if (Session::get('app_settings')->disable_sms == 0)
        setInterval(ajax_inbound_sms_messages, 30000); // every 30 seconds
        @endif
        setInterval(ajax_read_notifications, 75000); // every 75 seconds
    }

    function ajax_inbound_sms_messages() {
        if (inbound_messages) {
            inbound_messages.abort();
        }
        console.log('Fetching inbound messages');
        var inbound_messages = $("span.ajax_inbound_sms_messages").load("{{ url('/profilecontrol/ajaxdata/inbound_sms_messages') }}", function (response, status, inbound_messages) {
            var responseText = inbound_messages.responseText;
            console.log('Fetching inbound messages:' + status);
        });
    }

    function ajax_read_notifications() {
        if (read_notifications) {
            read_notifications.abort();
        }
        console.log('Fetching read notifications');
        var read_notifications = $("span.ajax_read_notifications").load("{{ url('/profilecontrol/ajaxdata/read_notifications') }}", function (response, status, system_errors) {
            var responseText = read_notifications.responseText;
            console.log('Fetching system errors:' + status);
        });
    }

    function ajax_pending_appointments() {
        if (pending_appointments) {
            pending_appointments.abort();
        }
        console.log('Fetching read notifications');
        var pending_appointments = $("span.ajax_pending_appointments").load("{{ url('/profilecontrol/ajaxdata/pending_appointments') }}", function (response, status, system_errors) {
            var responseText = pending_appointments.responseText;
            console.log('Fetching system errors:' + status);
        });
    }

</script>