<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">{{ trans('app.global_appointment_stats') }}</h3>
            <ul class="list-inline text-right">
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>{{ trans('app.active') }}</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>{{ trans('app.cancelled') }}</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>{{ trans('app.rescheduled') }}</h5>
                </li>
            </ul>
            <div id="morris-area-chart" style="height: 340px;"></div>
        </div>
    </div>
</div>