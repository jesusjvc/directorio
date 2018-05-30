<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
<form class="form-horizontal" role="form" method="POST" action="{{ url('/builder') }}">
    {{ csrf_field() }}
    <h1>language builder</h1>
    <div class="form-group">
        <input type="text" class="form-control" name="string" style="width:100%">

    </div>

    <div class="form-group">
        <button class="btn btn-default submit" type="submit">submit</button>
    </div>

    <div class="clearfix"></div>
    @if(Session::get('flash_message') !== null)
        {{ Session::get('flash_message') }}
    @endif

</form>
</body>
</html>
