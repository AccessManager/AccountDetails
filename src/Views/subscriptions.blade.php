@extends("AccountDetails::layout")
@section("tab-content")
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <h3 class="text-muted">
                @if(count($subscriptions))
                    Active Subscriptions
                @else
                    No Subscriptions Yet.
                @endif
            </h3>
        </div>
        <div class="col-md-6">
            <a href="{{route('account.subscriptions.add',[request()->segment(2)])}}" class="btn btn-success bg-green-gradient pull-right">
                new subscription
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($subscriptions as $subscription)
                @if( $subscription->isAdvancepaid() )
                    @include('AM3AccountDetail::partials.advancepaid-subscription', ['sub'=>$subscription])
                @endif
                @if( $subscription->isPrepaid() )
                    @include('AM3AccountDetail::partials.prepaid-subscription', ['sub'=>$subscription])
                @endif
            @endforeach
        </div>
    </div>
@endsection