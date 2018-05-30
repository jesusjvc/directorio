@if(Auth::guard(Session::get('guard'))->user()->isprofessional == 1)
    @php
        $professionalprofile = Auth::guard(Session::get('guard'))->user()->professional_profile;
        $professionalbranchcount = Auth::guard(Session::get('guard'))->user()->agenda->branches()->count();
    if(($professionalprofile != null) && (($professionalprofile->description == null || $professionalprofile->description == ''))):
        $professionalprofile = null;
    endif;
    $locationinstances = Auth::guard(Session::get('guard'))->user()->agenda->location_planners()->count();
    @endphp
@else
    @php
        $professionalprofile = null;
        $professionalbranchcount = 0;
        $locationinstances = 0;
    @endphp
@endif
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"><a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
                                  data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part"><a class="logo" href="{{ url('profilecontrol/dashboard') }}"><b>&nbsp;</b><span
                        class="hidden-xs"
                        style="white-space:nowrap;">{{ Auth::guard('profilecontrol')->user()->profile->business_name }}</span></a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-arrow-left-circle ti-menu"></i></a>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            @if((Auth::guard('profilecontrol')->user()->isuser == 1) || (Auth::guard('profilecontrol')->user()->isreception == 1))
                @if (Session::get('app_settings')->disable_sms == 0)
                <span class="ajax_inbound_sms_messages"></span>
                @endif
                <span class="ajax_read_notifications"></span>
                <span class="ajax_pending_appointments"></span>
            @endif

            @if((Auth::guard(Session::get('guard'))->user()->isprofessional == 1) &&
        (
        ($locationinstances == 0) ||
        ($professionalprofile == null) ||
        ($professionalbranchcount == 0)
            ))

                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i
                                class="fa fa-exclamation-circle"></i>
                        <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                    </a>
                    <ul class="dropdown-menu mailbox">
                        <li>
                            <div class="drop-title">
                                {{ trans('app.your_profile_needs_attention') }}
                            </div>
                        </li>
                        @if($professionalprofile == null)
                            <li>
                                <div class="message-center">
                                    <a href="{{ url('profilecontrol/public_profile') }}">
                                        <div class="mail-contnet">
                                            <h5>{{ trans('app.professional_profile') }}</h5>
                                            <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b">
                                            <span class="">{{ trans('app.your_professional_profile_has_not_been_completed_and_is_not_visible_to_the_outside_world') }}</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if($professionalbranchcount == null)
                            <li>
                                <div class="message-center">
                                    @if(Auth::guard(Session::get('guard'))->user()->isuser == 1)
                                        <a href="{{ url('/profilecontrol/professionals') }}">
                                            @else
                                                <a href="javascript:void(0)">
                                                    @endif
                                                    <div class="mail-contnet">
                                                        <h5>{{ trans('app.no_branches_assigned') }}</h5>
                                                        <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b">
                                            <span class="">
                                                {{ trans('app.your_profile_has_not_been_assigned_to_any_branches_in_order_to_schedule_appointments_you_have_to_be_assigned_to_at_least_one_branch') }}
                                                @if(Auth::guard(Session::get('guard'))->user()->isuser != 1)
                                                    {{ trans('app.you_do_not_have_access_to_assigning_yourself_to_a_branch_please_consult_the_account_owner_to_assign_you_to_a_branch') }}
                                                @endif
                                            </span>
                                                    </div>
                                                </a>
                                </div>
                            </li>
                        @endif
                        @if($locationinstances == 0)
                            <li>
                                <div class="message-center">
                                    <a href="{{ url('/profilecontrol/location_planner') }}">
                                        <div class="mail-contnet">
                                            <h5>{{ trans('app.location_planner') }}</h5>
                                            <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b">
                                            <span class="">
                                                {{ trans('app.your_location_planner_is_out_of_date_please_update_your_location_planner') }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>

            @endif

        <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img
                            src="{{ Session::get('avatar') }}" alt="avatar" width="36" class="img-circle"><b
                            class="hidden-xs">{{ ucwords(trans('app.' . Auth::guard('profilecontrol')->user()->prefix)) }} {{ ucwords(Auth::guard('profilecontrol')->user()->firstname) }} {{ ucwords(Auth::guard('profilecontrol')->user()->lastname) }}</b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ url(Session::get('guard') . '/myaccount') }}"><i
                                    class="fa fa-user"></i> {{ trans('app.my_account') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url(Session::get('guard') . '/myavatar') }}"><i
                                    class="fa fa-image"></i> {{ trans('app.my_avatar') }}</a>
                    </li>
                    <li>
                        <a href="{{ url(Session::get('guard') . '/mypassword') }}"><i
                                    class="fa fa-lock"></i> {{ trans('app.my_password') }}</a>
                    </li>
                    @if(Auth::guard(Session::get('guard'))->user()->isprofessional == 1)
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ url('/profilecontrol/public_profile') }}">
                                <i class="fa fa-info-circle"></i>
                                {{ trans('app.my_public_profile') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/location_planner') }}">
                                <i class="fa fa-map-marker"></i> {{ trans('app.location_planner') }}</a>
                        </li>
                    @endif
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> {{ trans('app.logout') }}</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- .Megamenu -->
            @if(Auth::guard(Session::get('guard'))->user()->isuser)
                <li class="right-side-toggle"><a class="waves-effect waves-light" href="javascript:void(0)"><i
                                class="fa fa-dollar"></i></a></li>
        @endif
        <!-- /.Megamenu -->
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>