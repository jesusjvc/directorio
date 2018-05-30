<div class="row">
    <div class="col-md-12">
        {!! trans('descriptions.profile_create_did_number') !!}
        <hr>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.did_number') }}</label>
            <div class="row">
                <div class="col-md-12">
                    <select class="form-control select2" style="width:100%;" name="did_number">
                        <option value="">{{ trans('app.do_not_assign_a_did_number') }}</option>
                        @if(count($did_numbers) > 0)
                            @foreach ($did_numbers as $didnumber)
                                <optgroup label="{{ $didnumber->country }}">
                                    <option value="{{ $didnumber->id }}" @if(old('did_number') == $didnumber->id) selected @endif>
                                        +{{ $didnumber->did_number }} {{ trans('app.with_capabilities') }} {{ strtoupper($didnumber->features) }}
                                    </option>
                                </optgroup>
                            @endforeach
                        @else
                            <option value="">
                                {{ trans('app.there_are_no_did_numbers_available') }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>