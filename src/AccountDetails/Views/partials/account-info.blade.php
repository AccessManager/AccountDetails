 <div class="box box-widget widget-user">
        <div class="widget-user-header bg-green-gradient">
            <h3 class="widget-user-username">
                {{$account->name}}
            </h3>
            <h5 class="widget-user-desc">
                account info
            </h5>
        </div>
        <div class="widget-user-image">
            <i class="fa fa-user fa-5x fa-inverse img-circle"></i>
        </div>
        <div class="no-padding">
            <ul class="list-group">
                <li class="list-group-item">
                            <span class="text-primary">
                                Account Username
                            </span>
                    <span class="pull-right text-muted">
                        {{$account->username}}
                            </span>
                </li>
                <li class="list-group-item">
                    <span class="text-primary">Account Created On</span>
                    <span class="pull-right text-muted">
                                {{$account->created_at->format('d M Y')}}
                            </span>
                </li>
                <li class="list-group-item text-primary">
                    Total Subscriptions
                    <span class="pull-right text-muted">
                        {{$account->subscriptions()->count()}}
                            </span>
                </li>
            </ul>
        </div>
    </div>