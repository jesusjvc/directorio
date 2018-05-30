<script type="text/javascript">
    $(document).ready(function() {
        var text_max = 480;
        $('#smsbox').html(text_max + " {{ trans('app.characters_remaining') }}");

        $('#textarea').keyup(function() {
            var text_length = $('#textarea').val().length;
            var text_remaining = text_max - text_length;

            $('#smsbox').html(text_remaining + " {{ trans('app.characters_remaining') }}");
        });
    });
</script>