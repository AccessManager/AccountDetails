<?php

namespace AccessManager\AccountDetails\AccountSubscription\Http\Controllers;


use AccessManager\AccountDetails\AccountSubscription\Models\PrepaidSubscription;
use AccessManager\AccountDetails\AccountSubscription\Requests\ChangeSubscriptionPasswordRequest;

class PrepaidSubscriptionController //extends AccountSubscriptionsController
{

    public function getServices($accountUsername, $subscriptionUsername )
    {
        $subscription = PrepaidSubscription::where('username', $subscriptionUsername)->firstOrFail();
        return view('AccountSubscription::prepaid.services', compact('subscription'));
    }

    public function getSessionHistory( $accountUsername, $subscriptionUsername )
    {
        $sessions = \DB::table('radacct')
            ->where('username', $subscriptionUsername)
            ->orderby('acctstarttime', 'DESC')
            ->paginate(10);
        return view('AccountSubscription::prepaid.session-history', compact('sessions'));
    }

    public function getRechargeHistory($accountUsername, $subscriptionUsername)
    {
        $subscription = PrepaidSubscription::where('username', $subscriptionUsername)->firstOrFail();
        $vouchers = $subscription->vouchers()->paginate(5);
        return view('AccountSubscription::prepaid.recharge-history', compact('vouchers'));
    }

    public function getChangePassword( $accountUsername, $subscriptionUsername )
    {
        return view('AccountSubscription::prepaid.change-password');
    }

    public function postChangePassword( $accountUsername, $subscriptionUsername, ChangeSubscriptionPasswordRequest $request )
    {
        try {
            $subscription = PrepaidSubscription::where('username', $subscriptionUsername)->firstOrFail();
            $subscription->password = $request->password;
            $subscription->saveOrFail();
            return back();
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

}