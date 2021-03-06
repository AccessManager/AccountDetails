<?php

namespace AccessManager\AccountDetails\AccountDetails\Http\Controllers;


use AccessManager\AccountDetails\AccountDetails\Http\Requests\AddSubscriptionRequest;
use AccessManager\AccountDetails\AccountDetails\Http\Requests\ChangeAccountPasswordRequest;
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

    public function getSubscriptions( $username )
    {
        $account = Account::where('username', $username)->firstOrFail();

        $subscriptions = $account->subscriptions->all();
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
        return view('AccountDetails::change-password');
    }

    public function postChangePassword( $accountUsername, ChangeAccountPasswordRequest $request )
    {
        try {
            $account = Account::where('username', $accountUsername)->firstOrFail();
            $account->password = bcrypt($request->password);
            $account->saveOrFail();
            return back();
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }
}