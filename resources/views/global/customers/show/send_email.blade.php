<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/send_mail') }}" id="idForm"
          reloadurl="{{ $reffered }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.send_an_email_to_customer_names',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}
                        <br>
                        <small>
                            {{ $customer->email }}
                        </small>
                        <div class="pull-right">
                            <a href="{{ $reffered }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-success">
                                {{ trans('app.cancel_and_go_back') }}
                            </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.email_subject') }} <span class="required"> * </span></label>
                                    <input type="text" maxlength="150" name="email_subject"
                                           class="form-control"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.email_body') }} <span class="required"> * </span></label>
                                    <textarea class="form-control" name="email_body"
                                              rows="18">{{ trans('app.dear_customer_names',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname . ',')]) }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="subnav">{{ trans('app.usable_variables') }}</h3>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <pre class="variableblock">@foreach($vars as $usable)<span
                                                class="badge badge-info lowercase nobold">{{ '&#123;&#123;' . $usable . '&#125;&#125;' }}
                                        </span> @endforeach </pre>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <hr>
                                <button class="btn btn-primary">{{ trans('app.send') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="{{ url('/assets/plugins/bower_components/trumbowyg/trumbowyg.min.js') }}"></script>
@include('global.includes.editor')