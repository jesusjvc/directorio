<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.validate_did_number') }}: +{{ $number->did_number }}</h4>
</div>
<div class="modal-body">
    <ul class="list-icons">
        @foreach($result as $key => $value)
            @if((is_string($value)) && ($key != 'uri') && ($key != 'features'))
                <li><i class="fa fa-chevron-right text-danger"></i><strong>{{ CustomHelper::reverseUscore($key) }}
                        :</strong> {{ $value }}</li>
            @endif
        @endforeach
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
</div>