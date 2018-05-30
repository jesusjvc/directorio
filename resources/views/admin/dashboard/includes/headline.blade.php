<div class="row">
    @foreach($headlines as $key => $headline)
        <div class="@if(count($headlines) == 2) col-md-6 @else col-md-3 @endif col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">{{ trans('app.' . $key) }}</h3>
                <ul class="list-inline">
                    <li class="text-left"><span class="counter" style="font-weight:400;">
                        {{ number_format($headline) }}
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
