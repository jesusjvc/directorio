<script>

    $(document).ajaxError(function (xhr, status, error) {
        if (status.status != 500) {
            if (status.statusText == 'timeout') {
                var theMessage = "{{ trans('app.a_system_timeout_has_occurred_this_error_usually_resolves_by_itself_however_if_it_reoccurs_make_sure_your_internet_connection_is_still_live') }}";
                console.log(status.statusText);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (status.statusText == 'error') {
                if (status.status == 418) {
                    var theMessage = status.responseText;
                } else {
                    var theMessage = "{{ trans('app.yikes_an_error_has_occurred_it_seems_that_your_network_is_disconnected_validate_your_network_connection_if_you_are_sure_that_you_are_connected_to_the_internet_or_local_network_dont_panic_this_error_usually_resolves_on_its_own') }}";
                }
                console.log('looks like the internet is disconnected');
                console.log(status);
            } else if (status.statusText == 'Not Found') {
                var theMessage = status.responseText;
                console.log(status.responseText);
            } else if (status.statusText == 'Unauthorized') {
                var theMessage = "{{ trans('app.the_session_has_expired_and_you_have_been_logged_out_the_system_will_redirect_you_back_to_the_login_page_in_a_moment') }}";
                setTimeout(function () {
                    location.reload();
                }, 4000);
                console.log('session has expired');
            } else {
                var theMessage = status.responseText;
                console.log(status.responseText);
            }
            console.log(status);
            swal({
                title: "{{ trans('app.an_error_has_occurred') }}",
                text: "" + theMessage,
                html: true,
                type: "warning",
                confirmButtonText: "{{ trans('app.okay') }}",
                closeOnConfirm: true
            });
        }
    });

    $(document).ajaxSuccess(function (response, status, xhr) {
        if (status.status == 201) {
            swal({
                title: "{{ trans('app.success') }}",
                text: "" + status.responseText,
                html: true,
                type: "success",
                confirmButtonText: "{{ trans('app.okay') }}",
                closeOnConfirm: true
            });
        }
        //if (typeof initReady === 'undefined') {
        initReady();

        //}
    });

    $(document).ajaxSend(function (xhr, status, error) {
        cache: false;
        async: false;
    });

    function hideModalIfVisible() {
        if ($('#ajaxmodel').is(':visible')) {
            $('#ajaxmodel').modal('hide'); // hide entire modal
            console.log('modal hidden');
        }
    }

    function prepareBeforeAjax(reloaddiv, reloadurl) {
        console.log('prepareBeforeAjax');
        if (reloaddiv == 'ajax_read_notifications') {
            var thespinner = '';
        } else if (reloaddiv == 'ajax_inbound_sms_messages') {
            var thespinner = '';
        } else if (reloaddiv == 'ajax_unrouted_inbound_sms_messages') {
            var thespinner = '';
        } else {
            var thespinner = '<div class="hideme" style="background-color: #FFFFFF; padding-top:50px; padding-bottom:50px; text-align:center;"><p><img src="{{ url("") }}/assets/loading-spinner-default.gif"></p><p>{{ trans("app.one_moment_please") }}</p></div>';
        }
        $(".modal-content").empty(); // on submit, empty modal contents and replace with spinner in the next step
        $(".modal-content").prepend(thespinner);
        $("." + reloaddiv).empty(); // empty parent page div and show loader to load
        $("." + reloaddiv).prepend(thespinner);
        $(".loadjs").empty();
    }

    var globalCount = 1;
    function doLoad(reloaddiv, reloadurl) {
        $("." + reloaddiv).load(reloadurl, function (response, status, xhr) {
            console.log('LOAD was initiated');
            if (xhr.readyState != 4) {
                var getCount = globalCount++;
                if (getCount < 4) {
                    console.log('Retrying: ' + getCount);
                    prepareBeforeAjax(reloaddiv, reloadurl);
                    doLoad(reloaddiv, reloadurl);
                } else {
                    location.reload();
                }
            }
            delete openGate;
            console.log('openGate == unset, ready for next call');
        });
    }

    function initReady() {

        console.log('------------');
        console.log('initReady Initiated');
        console.log('------------');

        $(".fetchajaxpage").on("click", function (e) {
            e.preventDefault();

            $(".fetchajaxpage").off('click');

            if (typeof openGate === 'undefined') {

                openGate = true;
                console.log('openGate == true');

                console.log('fetchajaxpage: Initiated');

                var reloadurl = $(e.currentTarget).attr("href");

                if ($(e.currentTarget).data("reloaddiv") === undefined) {
                    var reloaddiv = "reload";
                } else {
                    var reloaddiv = $(e.currentTarget).data("reloaddiv");
                }

                prepareBeforeAjax(reloaddiv, reloadurl);

                var xhr = doLoad(reloaddiv, reloadurl);
            }

//            $(".fetchajaxpage").on('click', e);


        });

        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();

            $("body").off('click');

            if (typeof openGate === 'undefined') {

                openGate = true;
                console.log('openGate == true');

                var reloadurl = $(e.currentTarget).attr("href");
                var reloaddiv = 'reload';

                prepareBeforeAjax(reloaddiv, reloadurl);
                var xhr = doLoad(reloaddiv, reloadurl);

            }

        });

        $("#q").on('submit', function (e) {


            e.preventDefault(); // avoid to execute the actual submit of the form.
            e.stopImmediatePropagation();

            $("#q").off('submit');

            console.log('#################');
            console.log('search Initiated');
            console.log('#################');

            var frm = $('#q');
            var url = frm.attr('action');

            if (reloaddiv === undefined) {
                var reloaddiv = "reload";
            }
            if (reloadurl === undefined) {
                var reloadurl = frm.attr('action');
            }

            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                beforeSend: function () {
                    console.log('Search: Preparing');
                    prepareBeforeAjax(reloaddiv, reloadurl);
                },
                success: function (data) {
                    $('.records').html(data);
//                    console.log(data);
                    console.log('Search: Success');
                },
                complete: function () {
                    console.log('Search: Complete');
                    hideModalIfVisible();
                },
                always: function () {
                    $("#q").on('submit', e);
                }
            })

        });

        $("#idForm").on("submit", function (ev) {
            ev.preventDefault();

            $("#idForm").off('submit');

            var reloaddiv = $('#idForm').attr('reloadiv');
            var reloadurl = $('#idForm').attr('reloadurl');
            var popload = $('#idForm').attr('popload');

            if (reloaddiv === undefined) {
                var reloaddiv = "reload";
            }
            if (reloadurl === undefined) {
                var reloadurl = $('#idForm').attr('action');
            }

            $.ajax({
                type: $('#idForm').attr('method'),
                url: $('#idForm').attr('action'),
                data: $('#idForm').serialize(),
                beforeSend: function () {
                    console.log('idForm: Preparing');
                    prepareBeforeAjax(reloaddiv, reloadurl);
                },
                success: function () {
                    console.log('idForm: Success');
                },
                complete: function () {
                    console.log('idForm: Complete');
                    hideModalIfVisible();
                    doLoad(reloaddiv, reloadurl);
                },
                always: function () {
                    $("#idForm").on('submit', ev);
                }
            });
        });

        $('.confirmajaxpost').on('click', function (e) {

            e.preventDefault();

            $(".confirmajaxpost").off('submit');

            var title = $(e.currentTarget).data("title");
            var description = $(e.currentTarget).data("description");
            var posturl = $(e.currentTarget).data("posturl");
            var reloadurl = $(e.currentTarget).data("reloadurl");
            var reloaddiv = $(e.currentTarget).data("reloaddiv");

            if (reloaddiv === undefined) {
                var reloaddiv = "reload";
            }
            if (reloadurl === undefined) {
                var reloadurl = frm.attr('action');
            }

            swal({
                title: "" + title,
                text: "" + description,
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ trans('app.confirm') }}",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            }, function () {

                $.ajax({
                    url: "" + posturl,
                    data: "_token={{ csrf_token() }}",
                    method: "POST", // post/get
                    beforeSend: function () {
                        console.log('confirmajaxpost: Preparing');
                        prepareBeforeAjax(reloaddiv, reloadurl);
                    },
                    success: function () {
                        console.log('confirmajaxpost: Success');
                    },
                    complete: function () {
                        console.log('confirmajaxpost: Complete');
                        hideModalIfVisible();
                        doLoad(reloaddiv, reloadurl);
                    },
                    always: function () {
                        $(".confirmajaxpost").on('submit', e);
                    }
                });
            });
        });

        $('.simpleconfirm').on('click', function (e) {

            e.preventDefault();

            var title = $(e.currentTarget).data("title");
            var description = $(e.currentTarget).data("description");

            swal({
                title: "" + title,
                text: "" + description,
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ trans('app.confirm') }}",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            });
        });

        $('.showSwal').on('click', function (e) {

            e.preventDefault();

            var title = $(e.currentTarget).data("title");
            var description = $(e.currentTarget).data("description");

            swal({
                title: "" + title,
                text: "" + description,
                html: true,
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ trans('app.okay') }}",
                closeOnConfirm: true,
                showLoaderOnConfirm: false,
            });
        });


        $('.postconfirm').on('click', function (e) {

            e.preventDefault();

            $(".simpleconfirm").off('click');

            var title = $(e.currentTarget).data("title");
            var description = $(e.currentTarget).data("description");
            var reloaddiv = $(e.currentTarget).data("reloaddiv");
            var reloadurl = $(e.currentTarget).data("reloadurl");
            var posturl = $(e.currentTarget).data("posturl");

            if (reloaddiv === undefined) {
                var reloaddiv = "reload";
            }

            swal({
                title: "" + title,
                text: "" + description,
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ trans('app.confirm') }}",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax({
                    type: "POST",
                    url: posturl,
                    data: "_token={{ csrf_token() }}&_method=DELETE",
                    beforeSend: function () {
                        console.log('confirmajaxpost: Preparing');
                        prepareBeforeAjax(reloaddiv, reloadurl);
                    },
                    success: function () {
                        console.log('confirmajaxpost: Success');
                    },
                    complete: function (response, status, xhr) {
                        console.log('confirmajaxpost: Complete');
                        hideModalIfVisible();
                        if (status == 'error') {
                            doLoad(reloaddiv, reloadurl);
                        } else {
                            if ($(e.currentTarget).data("redirect") !== undefined) {
                                setTimeout(function () {
                                    window.location.replace($(e.currentTarget).data("redirect"));
                                }, 3000);
                            } else {
                                doLoad(reloaddiv, reloadurl);
                            }
                        }
                    },
                    always: function () {
                        $(".postconfirm").on('click', e);
                    }
                });
            });
        });

        $('.noedit').on('click', function (e) {

            e.preventDefault();

            $(".noedit").off('click');

            var title = $(e.currentTarget).data("title");
            var description = $(e.currentTarget).data("description");

            swal({
                title: "" + title,
                text: "" + description,
                html: true,
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ trans('app.okay') }}",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            });
        });

    }

</script>