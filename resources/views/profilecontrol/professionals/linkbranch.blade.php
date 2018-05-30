<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            {{ trans('app.link_branches_to_professional_name', ["professional_name" => ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname)]) }}
            <br>
            <small>
                {{ $profile->business_name }}
            </small></h4>
    </div>
    @if(count($branches) == 0)
    <div class="modal-body">
        {{ trans('app.there_are_no_more_branches_available_to_link_this_professional_to_unable_to_proceed') }}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
    </div>
   @else
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/professionals/' . $professional->id . '/linkbranch') }}" id="idForm"
          reloadiv="reload" reloadurl="{{ url(Session::get('guard') . '/professionals') }}">
        <div class="modal-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <div class="row">
                @foreach($branches as $branch)
                    <div class="col-md-6">
                        <div class="checkbox-list">
                            <label style="font-weight:normal;">
                                <input type="checkbox" value="{{ $branch->id }}" name="id[]">
                                {{ $branch->branch_name }}
                            </label>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
        </div>
    </form>
    @endif
</div>
<div class="loadjs">
    @if (Request::ajax())
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    @endif
</div>