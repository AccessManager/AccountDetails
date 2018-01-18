@extends("AccountSubscription::free.layout")
@section('tab-content')
    {!! Form::open(['route'=>['account.subscriptions.free.change-password.post', request()->segment(2), request()->segment(4)],
        'class'=>'form-horizontal']) !!}
    @include("AccountSubscription::partials.change-password")
    {!! Form::close() !!}
@endsection