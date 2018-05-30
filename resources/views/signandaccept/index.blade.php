@extends('signandaccept.layout') @section('content')
    <form role="form" method="POST" action="{{ url('/signandaccept') }}">
        {{ csrf_field() }}
        <div class="text-center">
            {{ trans('app.enter_your_full_names_and_lastname_in_the_textbox_below') }} <span class="required"> * </span>
            <br><br>
        </div>
        <div class="form-body">
            <div class="form-group">
                <input type="text" maxlength="100" name="signed_by_names" class="form-control" autocomplete="off" required>
            </div>
        </div>
        <div class="text-center">
            {{ trans('app.please_enter_your_token_in_the_textfield_below') }} <span class="required"> * </span>
            <br><br>
        </div>
        <div class="form-body">
            <div class="form-group">
                <input type="text" maxlength="100" name="token" value="{{ $token }}" class="form-control" autocomplete="off" required>
            </div>
        </div>
        <div class="text-center" id="accept">
            <button type="submit" class="btn btn-primary">{{ trans('app.proceed') }}</button>
        </div>
    </form>
    <script type="text/javascript">
        var button = document.getElementById('accept')
        button.addEventListener('click', hideshow, true);

        function hideshow() {
            document.getElementById('accept').style.display = 'block';
            this.style.display = 'none';
        }
    </script>
@endsection