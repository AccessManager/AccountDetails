@extends("AccountSubscription::prepaid.layout")
@section('tab-content')
    {!! Form::open(['route'=>['account.subscriptions.prepaid.change-password.post', request()->segment(2), request()->segment(4)],
        'class'=>'form-horizontal']) !!}
    @include("AccountSubscription::partials.change-password")
    {!! Form::close() !!}
@endsection