@extends("AccountSubscription::prepaid.layout")
@section("tab-content")

    @if( $subscription->name == NULL )
        <h3 class="text-muted">
            never recharged.
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
                    {{\AccessManager\Constants\Subscription::PREPAID_STRING}}
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
            </div><div class="col-md-3">
                <p class="text-primary">
                    Last Recharge On:
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-muted">
                    {{$subscription->settings->recharged_on->format('d M y H:i')}}
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
        <div class="col-md-2">
            <div class="btn-group btn-group-sm pull-left">
                <a href="{{route('prepaid.recharge', ['username'=>$subscription->username, 'referrer'=>url()->current()])}}" class="btn btn-success bg-green-gradient">Recharge</a>
                {{--@if( $subscription->services != NULL )--}}
                    {{--<a href="#" class="btn btn-success bg-green-gradient dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Refill</a></li>--}}
                    {{--</ul>--}}
                {{--@endif--}}
            </div>

        </div>
    </div>

@endsection