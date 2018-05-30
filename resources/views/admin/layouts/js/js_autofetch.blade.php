<script>
    // ajax autoload and update
    function initiateAutoUpdate() {
        ajax_system_errors();
        @if(Session::get('app_settings')->disable_sms == 0)
        ajax_inbound_sms_messages();
        ajax_unrouted_inbound_sms_messages(); // only on load
        @endif
        ajax_read_notifications(); // only on load
        @if(Session::get('app_settings')->disable_sms == 0)
        setInterval(ajax_inbound_sms_messages, 30000); // every 30 seconds
        setInterval(ajax_unrouted_inbound_sms_messages, 60000); // every minute
        @endif
        setInterval(ajax_system_errors, 300000); // every 5 minutes
        setInterval(ajax_read_notifications, 75000); // every 75 seconds
    }

    function ajax_inbound_sms_messages() {
        if (inbound_messages) {
            inbound_messages.abort();
        }
        console.log('Fetching inbound messages');
        var inbound_messages = $("span.ajax_inbound_sms_messages").load("{{ url(Session::get('guard') . '/ajaxdata/inbound_sms_messages') }}", function (response, status, inbound_messages) {
            var responseText = inbound_messages.responseText;
            console.log('Fetching inbound messages:' + status);
        });
    }

    function ajax_unrouted_inbound_sms_messages() {
        if (unrouted_inbound_messages) {
            unrouted_inbound_messages.abort();
        }
        console.log('Fetching unrouted inbound messages');
        var unrouted_inbound_messages = $("span.ajax_unrouted_inbound_sms_messages").load("{{ url(Session::get('guard') . '/ajaxdata/unrouted_inbound_sms_messages') }}", function (response, status, unrouted_inbound_messages) {
            var responseText = unrouted_inbound_messages.responseText;
            console.log('Fetching unrouted inbound messages:' + status);
        });
    }

    function ajax_system_errors() {
        if (system_errors) {
            system_errors.abort();
        }
        console.log('Fetching system errors');
        var system_errors = $("span.ajax_system_errors").load("{{ url(Session::get('guard') . '/ajaxdata/system_errors') }}", function (response, status, system_errors) {
            var responseText = system_errors.responseText;
            console.log('Fetching system errors:' + status);
        });
    }

    function ajax_read_notifications() {
        if (read_notifications) {
            read_notifications.abort();
        }
        console.log('Fetching read notifications');
        var read_notifications = $("span.ajax_read_notifications").load("{{ url(Session::get('guard') . '/ajaxdata/read_notifications') }}", function (response, status, system_errors) {
            var responseText = read_notifications.responseText;
            console.log('Fetching system errors:' + status);
        });
    }

</script>