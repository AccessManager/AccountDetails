@extends("AccountSubscription::free.layout")
@section('tab-content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h5 class="text-muted">
                Assign Route
            </h5>
            <hr>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    {!! Form::open(['route'=>['account.subscriptions.free.assign-route.post', request()->segment(2), request()->segment(4)],
            'class'=>'form-horizontal']) !!}
                    <fieldset>
                        <div class="form-group">
                            <div class="col-xs-10">
                                {!! Form::text('cidr', null, ['class'=>'form-control', 'placeholder'=>'example: 192.168.1.0/30']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-xs-offset-4">
                                {!! Form::submit('Assign', ['class'=>'btn btn-flat btn-info']) !!}
                            </div>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection