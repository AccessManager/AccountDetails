<?php

namespace AccessManager\AccountDetails\Http\Controllers;


use AccessManager\Base\Http\Controller\AdminBaseController;

class AccountDetailsController extends AdminBaseController
{
    public function getSubscriptions()
    {
        $subscriptions = [];
        return view('AccountDetails::subscriptions', compact('subscriptions'));
    }

    public function getDemographics()
    {
        return view("AccountDetails::demographics");
    }
}