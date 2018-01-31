@extends("AccountDetails::layout")
@section("tab-content")
    {!! Form::open(['route'=>['account.change-password.post', request()->segment(2)],
        'class'=>'form-horizontal']) !!}
    @include("AccountSubscription::partials.change-password")
    {!! Form::close() !!}
@endsection