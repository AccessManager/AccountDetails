<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\Base\Models\AdminBaseModel;

class AccountSubscriptionLimit extends AdminBaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'account_subscription_id', 'time_limit', 'time_unit', 'data_limit', 'data_unit',
        'reset_every', 'reset_every_unit',
    ];


}