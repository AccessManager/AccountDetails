@extends("AccountSubscription::free.layout")
@section("tab-content")
    @if( $subscription->name == null )
        <h3 class="text-muted">
            No Service Assigned.
        </h3>
    @else

        <div class="row">
            <div class="col-md-3">
                <p class="text-primary">
                    Subscription Type:
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    {{\AccessManager\Constants\Subscription::FREE_STRING}}
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-primary">
                    Assigned On:
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    {{$subscription->created_at->format('d M y H:i')}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p class="text-primary">
                    Service Plan
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    {{$subscription->name}}

                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p class="text-primary">
                    Time Balance:
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    @if( $subscription->limits && $subscription->limits->time_limit !== null )
                        {{\AccessManager\Helpers\Format::secondsToReadable($subscription->services->time_balance)}}
                    @else
                        N/A
                    @endif
                </p>
            </div><div class="col-md-3">
                <p class="text-primary">
                    Expires On:
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-muted">
                    @if($subscription->expires_on instanceof DateTime)
                        {{$subscription->expires_on->format('d M y H:i')}}
                    @else
                        Never
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p class="text-primary">
                    Data Balance:
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    @if( $subscription->limits && $subscription->limits->data_limit !== null )
                        {{AccessManager\Helpers\Format::bytesToReadable($subscription->services->data_balance)}}
                    @else
                        N/A
                    @endif
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-primary">
                    After Quota Access:
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    {{$subscription->aqPolicy ? 'Allowed' : 'Not Allowed'}}
                </p>
            </div>
        </div>

    @endif
    <div class="row">
        <div class="col-xs-3">
            <div class="btn-group btn-group-sm pull-left">
                <a
                    href="{{route('account.subscriptions.free.assign-services', [$subscription->account->username, $subscription->username])}}"
                    class="btn btn-success bg-green-gradient">
                    @if( $subscription->name == null )
                        Assign Service Plan
                        @else
                        Change Service Plan
                        @endif
                </a>
            </div>
        </div>
    </div>
@endsection