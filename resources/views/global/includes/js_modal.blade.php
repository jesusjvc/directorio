<script type="text/javascript">
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        //$(".modalhide").empty();
    });
    $('body').on('show.bs.modal', '.modal', function () {
        $('.modal-content').empty(); // on modal submit, empty modal contents and show loader in next step =>> fetching modal content
        $('.modal-content').prepend('<div class="hideme" style="padding-top:50px; padding-bottom:50px; text-align:center;"><p><img src="{{ url("") }}/assets/loading-spinner-default.gif"></p><p>{{ trans("app.fetching_data") }}</p></div>');
    });
</script>