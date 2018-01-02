<?php

namespace AccessManager\AccountDetails\AccountSubscription\Http\Controllers;



use AccessManager\AccountDetails\AccountSubscription\Models\FreeSubscription;
use AccessManager\AccountDetails\AccountSubscription\Requests\ChangeSubscriptionPasswordRequest;
use AccessManager\AccountDetails\AccountSubscription\Requests\FreeSubscriptionPlanAssignRequest;
use AccessManager\AccountDetails\Libraries\FreeSubscriptionPlanAssignmentHandler;
use AccessManager\Services\Plans\Models\ServicePlan;

class FreeSubscriptionController //extends AccountSubscriptionsController
{
    public function getServices($accountUsername, $subscriptionUsername )
    {
        $subscription = FreeSubscription::where('username', $subscriptionUsername)->firstOrFail();
        return view('AccountSubscription::free.services', compact('subscription'));
    }

    public function getSessionHistory( $accountUsername, $subscriptionUsername )
    {
        return view('AccountSubscription::free.session-history');
    }

    public function getChangePassword( $accountUsername, $subscriptionUsername )
    {
        return view('AccountSubscription::free.change-password');
    }

    public function postChangePassword( $accountUsername, $subscriptionUsername, ChangeSubscriptionPasswordRequest $request )
    {
        try {
            $subscription = AccountSubscription::where('username', $subscriptionUsername)->firstOrFail();
            $subscription->password = $request->password;
            $subscription->saveOrFail();
            return back();
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
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

        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }
}