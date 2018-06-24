@extends("AccountSubscription::free.layout")
@section('tab-content')
    <div class="row">
        <div class="col-xs-6">
            <h5 class="text-muted">
                Static IP
            </h5>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    @if($static_ip == null)
                        Not Assigned
                        @else
                        {!! long2ip($static_ip->address) !!}
                    @endif
                </div>
                <div class="col-xs-6">
                    @if($static_ip == null )
                        <a href="{{route('account.subscriptions.free.assign-ip', [request()->segment(2), request()->segment(4)])}}" class="btn btn-xs btn-flat btn-info bg-aqua-gradient">
                            Assign
                        </a>
                    @else
                        {!! Form::open(['route'=>['account.subscriptions.free.remove-ip.post', request()->segment(2), request()->segment(4),], 'onSubmit'=>"confirm('are you sure?')"]) !!}
                        {!! Form::hidden('framed_ip', $static_ip->id) !!}
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('account.subscriptions.free.assign-ip', [request()->segment(2), request()->segment(4)])}}" class="btn btn-flat btn-info bg-aqua-gradient">
                                Change
                            </a>
                            <button class="btn btn-flat btn-danger bg-red-gradient">
                                Remove
                            </button>
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <h5 class="text-muted">
                Route Subnet
            </h5>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    @if($route == null)
                        Not Assigned
                    @else
                        {!! $route->cidr !!}
                    @endif
                </div>
                <div class="col-xs-6">
                    @if($route == null )
                        <a href="{{route('account.subscriptions.free.assign-route', [request()->segment(2), request()->segment(4)])}}" class="btn btn-xs btn-flat btn-info bg-aqua-gradient">
                            Assign
                        </a>
                    @else
                        {!! Form::open(['route'=>['account.subscriptions.free.remove-route.post', request()->segment(2), request()->segment(4),], 'onSubmit'=>"confirm('are you sure?')"]) !!}
                        {!! Form::hidden('framed_ip', $static_ip->id) !!}
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('account.subscriptions.free.assign-route', [request()->segment(2), request()->segment(4)])}}" class="btn btn-flat btn-info bg-aqua-gradient">
                                Change
                            </a>
                            <button class="btn btn-flat btn-danger bg-red-gradient">
                                Remove
                            </button>
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection