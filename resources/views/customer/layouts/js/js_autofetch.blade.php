<script>
    // ajax autoload and update
    function initiateAutoUpdate() {
        ajax_read_notifications(); // only on load
        setInterval(ajax_read_notifications, 75000); // every 75 seconds
    }

    function ajax_read_notifications() {
        if (read_notifications) {
            read_notifications.abort();
        }
        console.log('Fetching read notifications');
        var read_notifications = $("span.ajax_read_notifications").load("{{ url('/customer/ajaxdata/read_notifications') }}", function (response, status, system_errors) {
            var responseText = read_notifications.responseText;
            console.log('Fetching system errors:' + status);
        });
    }

</script>