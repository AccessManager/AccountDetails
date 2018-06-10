<?php

namespace AccessManager\AccountDetails\AccountSubscription\Http\Controllers;



use AccessManager\AccountDetails\AccountSubscription\Models\AccountSubscriptionRoute;
use AccessManager\AccountDetails\AccountSubscription\Models\FreeSubscription;
use AccessManager\AccountDetails\AccountSubscription\Requests\ChangeSubscriptionPasswordRequest;
use AccessManager\AccountDetails\AccountSubscription\Requests\FreeSubscriptionPlanAssignRequest;
use AccessManager\AccountDetails\Libraries\FreeSubscriptionPlanAssignmentHandler;
use AccessManager\Routers\Models\NetworkSubnet;
use AccessManager\Routers\Models\NetworkSubnetIp;
use AccessManager\Services\Plans\Models\ServicePlan;
use Carbon\Carbon;

class FreeSubscriptionController
{
    public function getServices($accountUsername, $subscriptionUsername )
    {
        $subscription = FreeSubscription::where('username', $subscriptionUsername)->firstOrFail();
        return view('AccountSubscription::free.services', compact('subscription'));
    }

    public function getSessionHistory( $accountUsername, $subscriptionUsername )
    {
        $sessions = \DB::table('radacct')
            ->where('username', $subscriptionUsername)
            ->orderby('acctstarttime', 'DESC')
            ->paginate(10);

        return view('AccountSubscription::free.session-history', compact('sessions'));
    }

    public function getChangePassword( $accountUsername, $subscriptionUsername )
    {
        return view('AccountSubscription::free.change-password');
    }

    public function postChangePassword( $accountUsername, $subscriptionUsername, ChangeSubscriptionPasswordRequest $request )
    {
        try {
            $subscription = FreeSubscription::where('username', $subscriptionUsername)->firstOrFail();
            $subscription->password = $request->password;
            $subscription->saveOrFail();
            return back();
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function getNetworkConfig()
    {
        $static_ip = NetworkSubnetIp::where('user_id', auth()->user()->id)->first();
        $route = AccountSubscriptionRoute::where('account_subscription_id', auth()->user()->id)->first();
        return view('AccountSubscription::free.network-config', compact('static_ip', 'route'));
    }

    public function getAssignIp()
    {
        $subnets = NetworkSubnet::pluck('cidr', 'id');
        return view('AccountSubscription::free.assign-ip', compact('subnets'));
    }

    public function postAssignIp($accountUsername, $subscriptionUsername )
    {
        try{
            $subscription = FreeSubscription::whereUsername($subscriptionUsername)->firstOrFail();
            $framedIp = NetworkSubnetIp::findOrFail(request('framed_ip'));
            NetworkSubnetIp::where(['user_id'=>$subscription->id])->update(['user_id'=>null, 'assigned_on'=>null]);
//            dd($framedIp);
            $framedIp->user_id = $subscription->id;
            $framedIp->assigned_on = new Carbon;
            $framedIp->save();
            return redirect()->route('account.subscriptions.free.network-config', [$accountUsername, $subscriptionUsername]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function postRemoveIp()
    {
        try{
            $framedIp = NetworkSubnetIp::findOrFail(request('framed_ip'));
            $framedIp->update(['assigned_on'=>null, 'user_id' => null]);
            return back();
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function getAssignRoute()
    {

    }

    public function postAssignRoute()
    {

    }

    public function getAssignServices( $accountUsername, $subscriptionUsername )
    {
        $plans = ServicePlan::pluck('name', 'id');
        return view("AccountSubscription::free.assign-services", compact('plans'));
    }

    public function postAssignServices( $accountUsername, $subscriptionUsername, FreeSubscriptionPlanAssignRequest $request )
    {
        try {
            $subscription = FreeSubscription::where('username', $subscriptionUsername)->firstOrFail();
            $plan = ServicePlan::findOrFail($request->plan_id);
            $handler = new FreeSubscriptionPlanAssignmentHandler($subscription, $plan, $request->expires_on);
            $handler->process();
            return redirect()->route('account.subscriptions.free.services',[$accountUsername, $subscriptionUsername]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function getFlipStatus( $accountUsername, $subscriptionUsername )
    {
        try{
            $subscription = FreeSubscription::where('username', $subscriptionUsername)->firstOrFail();
            $subscription->status = $subscription->status ^ 1;
            $subscription->save();
            return back();
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }
}