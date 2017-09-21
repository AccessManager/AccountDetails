<div class="box box-warning collapsed-box box-solid">
    <div class="box-header with-border bg-yellow-gradient">
        <h3 class="box-title">
            {{$sub->username}}
        </h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-2">
                <p class="text-primary">
                    Sub. Type:
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-muted">
                    {{\AccessManager\Constants\Subscription::PREPAID_STRING}}
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-primary">
                    Assigned On:
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-muted">
                    {{$sub->created_at->format('d M y')}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p class="text-primary">
                    Service Plan:
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-muted">
                    {{$sub->plan_name}}
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-primary">
                    Expires On:
                </p>
            </div>
            <div class="col-md-3">
                <p class="text-muted">
                    @if( $sub->expires_on == null)
                        Never
                    @else
                        {{date('d-M-y', strtotime($sub->expires_on))}}
                    @endif
                </p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3 col-md-offset-9">
                <div class="btn-group btn-group-xs pull-right">

                    <a href="{{route('account.subscriptions.prepaid', [request()->segment(2), $sub->username])}}" class="btn btn-primary bg-blue-gradient">
                        Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>