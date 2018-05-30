<form role="form" method="POST" action="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/add_item') }}" id="idForm"
      reloadiv="reload" reloadurl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}">
    {{ csrf_field() }}
    <div class="">

        <div class="col-md-4">
            <div class="form-group">
                <label class="oneline">{{ trans('app.service_item') }} <span class="required"> * </span></label>
                <select class="form-control select2" name="service_item_id" id="service_items" required>
                    <option value="" selected>{{ trans('app.select_an_item') }}</option>
                    @foreach ($service_categories as $category)
                        <optgroup label="{{ $category->category_name }}">
                            @foreach ($category->service_items as $item)
                                <option value="{{ $item->id }}" care_description="{{ $item->name }}"
                                        care_amount="{{ number_format($item->amount,2) }}">{{ $item->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="oneline">{{ trans('app.item_description') }} <span class="required"> * </span></label>
                <input type="text" maxlength="150" name="description" id="description" class="form-control" required>
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <label class="oneline">{{ trans('app.quantity') }} <span class="required"> * </span></label>
                <input type="number" min="0" step="1" maxlength="150" name="quantity" value="1" class="form-control"
                       required>
            </div>
        </div>

        <div class="col-md-2">
            <label class="oneline">{{ trans('app.item_amount') }} <span class="required"> * </span></label>
            <div class="input-group">
                <input type="text" name="item_amount" id="item_amount" class="form-control" required>
                <div class="input-group-addon">{{ $profile->profile_billing->default_currency }}</div>
            </div>
        </div>

        {{--<div class="col-md-2">--}}
        {{--<div class="form-group">--}}
        {{--<label>{{ trans('app.tax_rate') }} <span class="required"> * </span></label>--}}
        {{--<select class="form-control select2" required>--}}
        {{--<option value="" selected>{{ trans('app.no_tax') }}</option>--}}
        {{--@foreach ($tax_configurations as $configuration)--}}
        {{--<option value="{{ $configuration->id }}">{{ $configuration->title }}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-1 text-center">
            <label class="oneline"> </label><br>
            <a class="fetchajaxpage" href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}">
                <span type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></span>
            </a>
            <button type="submit" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>
        </div>

    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $("#service_items").on("change", function () {
            $("#description").val($(this).find("option:selected").attr("care_description"));
            $("#item_amount").val($(this).find("option:selected").attr("care_amount"));
        });

//        $(".select2").select2();
    });

    {{--$(".fetchajax").click(function (e) {--}}
    {{--e.preventDefault();--}}

    {{--var reloadurl = $(e.currentTarget).data("reloadurl");--}}

    {{--$('.reload').empty();--}}
    {{--$(".reload").prepend('<div style="padding-top:50px; padding-bottom:50px; text-align:center;"><p><img src="{{ url("") }}/assets/loading-spinner-default.gif"></p><p>{{ trans("app.one_moment_please") }}</p></div>');--}}
    {{--var xhr = $(".reload").load(reloadurl, function (response, status, xhr) {--}}
    {{--e.preventDefault();--}}
    {{--var responseText = xhr.responseText;--}}
    {{--});--}}

    {{--xhr.abort();--}}

    {{--$('.reload').show();--}}

    {{--});--}}
</script>