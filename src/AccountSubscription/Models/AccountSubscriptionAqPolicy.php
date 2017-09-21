<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\Base\Models\AdminBaseModel;

class AccountSubscriptionAqPolicy extends AdminBaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'account_subscription_id', 'min_up', 'min_up_unit', 'min_down',
        'min_down_unit', 'max_up', 'max_up_unit', 'max_down', 'max_down_unit'
    ];
}