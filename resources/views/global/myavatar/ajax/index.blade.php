<div class="{{ $sectiontoreload }}">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/myavatar') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div align="center">
                        <img src="{{ $avatar }}" class="img-circle img-responsive" style="padding-bottom:20px;" alt="">
                        <h3 class="avatar">{{ Auth::guard(Session::get('guard'))->user()->firstname }} {{ Auth::guard(Session::get('guard'))->user()->lastname }}</h3>
                    </div>
                </div>
                <div class="col-md-9">

                    <div class="form-group">
                        <input type="file" id="input-file-now" name="file" class="dropify"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-info" type="submit">
                {{ trans('app.change_avatar') }}
            </button>
        </div>
    </form>
</div>