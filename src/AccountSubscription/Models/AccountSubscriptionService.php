<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\Base\Models\AdminBaseModel;

class AccountSubscriptionService extends AdminBaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'account_subscription_id', 'time_balance', 'data_balance', 'last_reset_on', 'exhausted',
    ];


}