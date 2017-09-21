@extends("Base::canvas")
@section("header")
    {{$subscription->username}}
    <small>
        {{$account->fname}} {{$account->lname}}
    </small>
@endsection
@section("main-content")
    <div class="row">
        <div class="col-xs-3">
            @include("AccountDetails::partials.account-info")
        </div>
        <div class="col-xs-9">
            @yield("content")
        </div>
    </div>
@endsection