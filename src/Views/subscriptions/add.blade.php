@extends("AccountDetails::layout")
@section("tab-content")
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <h3 class="text-muted">
                New Subscription
            </h3>
        </div>
    </div>
    {!! Form::open(['route'=>['account.subscriptions.add.post', request()->segment(3)],'class'=>'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div class="fieldset">
                <div class="form-group">
                    {!! Form::text('uname',NULL,['class'=>'form-control','placeholder'=>'username for subscription']) !!}
                    {{$errors->first('uname')}}
                </div>
                <div class="form-group">
                    {!! Form::password('pword', ['class'=>'form-control','placeholder'=>'password for subscription']) !!}
                    {{$errors->first('pword')}}
                </div>
                <div class="form-group">
                    {!! Form::password('pword_confirmation', ['class'=>'form-control','placeholder'=>'confirm password']) !!}
                    {{$errors->first('pword_confirmation')}}
                </div>
                <div class="form-group">
                    {!! Form::submit('Submit',['class'=>'btn btn-warning bg-orange-active btn-block btn-flat']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="fieldset">
                <div class="form-group">
                    <label for="" class="col-xs-5">
                        Subscription Type:
                    </label>
                    <div class="col-xs-7">
                        <label for="pp" class="radio-inline">
                            {!! Form::radio('sub_type',\AccessManager\Constants\Subscription::PREPAID, true, ['id'=>'pp']) !!}
                            Prepaid
                        </label>
                        {{$errors->first('sub_type')}}
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