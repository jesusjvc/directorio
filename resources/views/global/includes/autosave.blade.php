<script type="text/javascript">
    $(document).ready(function () {
        $(".autosave").autoSave(function () {
            var time = new Date().getTime();
        });
    });

    (function ($) {
        $.fn.autoSave = function (callback) {
            console.log('Autosave initiated');
            return this.each(function () {
                var timer = 0;
                var $this = $(this);
                var delay = 2000;
//                $this.keyup(function () {
                $this.change(function () {
                    clearTimeout(timer);

                    timer = setTimeout(function () {
                        callback();

                        var frm = $('.autosave');

                        $.ajax({
                            type: frm.attr('method'),
                            url: frm.attr('action'),
                            data: frm.serialize(),
                            success: function (data) {
                                console.log('Autosave performed');
                                $("#autosaveperformed").show().delay(2000).fadeOut();
                            }
                        }).done(function () {
//                            alert('saved');
                        }).fail(function (xhr, status, error) {
                            swal({
                                title: "{{ trans('app.notice') }}",
                                text: "{{ trans('app.failed_to_save_changes') }}",
//                                text: xhr.responseText,
                                html: true,
                                confirmButtonText: "{{ trans('app.okay') }}",
                                closeOnConfirm: true
                            });

                        });

                    }, delay);

                });
            });
        };
    })(jQuery);
</script>