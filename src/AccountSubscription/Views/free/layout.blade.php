@extends("AccountSubscription::layout")
@section("content")

    <?php
    $services           = NULL;
    $rechargeHistory    = NULL;
    $sessionHistory     = NULL;
    $more               = NULL;

    switch( request()->segment(5) ) {
        case 'services' :
        case 'assign-services':
            $services = 'active';
            break;
        case 'session-history' :
            $sessionHistory = 'active';
            break;
        default:
            $more = 'active';
    }
    ?>
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="{{$services}}"><a href="{{route('account.subscriptions.free.services', [request()->segment(2), request()->segment(4)])}}">Services</a></li>
            <li class="{{$sessionHistory}}"><a href="{{route('account.subscriptions.free.session-history', [request()->segment(2), request()->segment(4)])}}">Session History</a></li>
            <li class="dropdown  {{$more}}">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    More <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('account.subscriptions.free.change-password', [request()->segment(2), request()->segment(4)])}}">
                            Change Password
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pull-right">
                <a href="{{route('account.subscriptions', request()->segment(2))}}" class="btn btn-box-tool">
                <span class="badge bg-green-gradient">
                    <i class="fa fa-chevron-circle-left"></i>&nbsp;BACK
                </span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            @yield('tab-content')
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->

@endsection