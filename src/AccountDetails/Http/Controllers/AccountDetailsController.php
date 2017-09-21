<?php

namespace AccessManager\AccountDetails\AccountDetails\Http\Controllers;


use AccessManager\AccountDetails\AccountDetails\Http\Requests\AddSubscriptionRequest;
use AccessManager\AccountDetails\AccountSubscription\Models\AccountSubscription;
use AccessManager\Accounts\Models\Account;
use AccessManager\Base\Http\Controller\AdminBaseController;
use AccessManager\Services\Plans\Models\ServicePlan;

class AccountDetailsController extends AdminBaseController
{

    public function getDemographics()
    {
        return view("AccountDetails::demographics");
    }

    public function getSubscriptions( AccountSubscription $accountSubscription )
    {
        $subscriptions = $accountSubscription->all();
        return view('AccountDetails::subscriptions', compact('subscriptions'));
    }

    public function getAddSubscription()
    {
        return view('AccountDetails::add_subscription', compact('plans'));
    }

    public function postAddSubscription( $username, Account $account, AddSubscriptionRequest $request )
    {
        try {
            $account = $account->where('username', $username)->firstOrFail();
            $account->subscriptions()->create(
                $request->only('username', 'password', 'type')
            );
            return redirect()->route('account.subscriptions', [$account->username]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function getChangePassword()
    {

    }

    public function postChangePassword()
    {

    }
}