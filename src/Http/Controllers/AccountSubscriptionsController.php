<?php

namespace AccessManager\AccountDetails\Http\Controllers;


use AccessManager\AccountDetails\Http\Requests\AddSubscriptionRequest;
use AccessManager\Base\Http\Controller\AdminBaseController;
use AccessManager\Services\Plans\Models\ServicePlan;

class AccountSubscriptionsController extends AdminBaseController
{

    public function getAdd()
    {
        $plans = ServicePlan::pluck('name', 'id');
        return view('AccountDetails::subscriptions.add', compact('plans'));
    }

    public function postAdd( AddSubscriptionRequest $request )
    {
        dd($request->all());
    }

    public function getChangePassword()
    {

    }

    public function postChangePassword()
    {

    }
}