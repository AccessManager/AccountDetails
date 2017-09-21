@extends("AccountDetails::layout")
@section("tab-content")
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <h3 class="text-muted">
                New Subscription
            </h3>
        </div>
    </div>
    {!! Form::open(['route'=>['account.subscriptions.add.post', request()->segment(2)],'class'=>'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div class="fieldset">
                <div class="form-group">
                    {!! Form::text('username',NULL,['class'=>'form-control','placeholder'=>'username for subscription']) !!}
                    {{$errors->first('username')}}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class'=>'form-control','placeholder'=>'password for subscription']) !!}
                    {{$errors->first('password')}}
                </div>
                <div class="form-group">
                    {!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'confirm password']) !!}
                    {{$errors->first('password_confirmation')}}
                </div>
                <div class="form-group">
                    {!! Form::submit('Submit',['class'=>'btn btn-warning bg-orange-active btn-block btn-flat']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="fieldset">
                <div class="form-group">
                    <div class="col-xs-5">
                        {!! Form::select('type',
                        [\AccessManager\Constants\Subscription::PREPAID=>\AccessManager\Constants\Subscription::PREPAID_STRING,
                        \AccessManager\Constants\Subscription::FREE=>\AccessManager\Constants\Subscription::FREE_STRING,],
                        \AccessManager\Constants\Subscription::PREPAID, ['class'=>'form-control', 'data-title'=>'Subscription Type']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-4">

        </div>
    </div>
    {!! Form::close() !!}
@endsection