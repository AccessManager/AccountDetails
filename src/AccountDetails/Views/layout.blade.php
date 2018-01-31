@extends("Base::canvas")
@section("header")
    {{$account->fname}} {{$account->lname}}
@endsection
@section("main-content")
    <div class="row">
        <div class="col-xs-3">
            @include("AccountDetails::partials.account-info")
        </div>
        <div class="col-xs-9">
        <?php
        $overview           = NULL;
        $subscriptions      = NULL;
        $demographics       = NULL;
        $accountLedger      = NULL;
        $sessionHistory     = NULL;

        switch( request()->segment(3) ) {
            case 'overview' :
                $overview = 'active';
                break;
            case 'subscriptions' :
                $subscriptions = 'active';
                break;
            case 'demographics' :
                $demographics = 'active';
                break;
            case 'account-ledger' :
                $accountLedger = 'active';
                break;
            case 'session-history' :
                $sessionHistory = 'active';
                break;
        }
        ?>
        <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="{{$subscriptions}}"><a href="{{route('account.subscriptions',request()->segment(2))}}">Subscriptions</a></li>
                    <li class="{{$demographics}}"><a href="{{route('account.demographics',request()->segment(2))}}">Demographics</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            More <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('account.change-password', request()->segment(2) )}}">
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="tab-content">
                    @yield('tab-content')
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>
@endsection