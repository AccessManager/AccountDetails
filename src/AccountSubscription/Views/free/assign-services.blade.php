@extends("AccountSubscription::free.layout")
@section("tab-content")
    {!! Form::open([
    'route'=>['account.subscriptions.free.assign-services.post', request()->segment(2), request()->segment(4)],
    'class'=>'form-horizontal'
    ]) !!}
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <fieldset>
                <div class="form-group">
                    <label for="" class="control-label col-md-4">Select Service Plan</label>
                    <div class="col-md-6">
                        {!! Form::select('plan_id', $plans, NULL, ['class'=>'form-control', 'data-live-search'=>'true', ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-4">Service Expires On</label>
                    <div class="col-md-6">
                        {!! Form::text('expires_on', NULL, ['class'=>'form-control', 'placeholder'=>'blank for never', ]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-md-offset-4">
            {!! Form::submit('Assign', ['class'=>'form-control btn btn-block btn-flat bg-orange']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection