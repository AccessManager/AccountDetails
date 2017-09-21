<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\Base\Models\AdminBaseModel;

class PrepaidSubscriptionSetting extends AdminBaseModel
{
    public $timestamps = false;
    protected $fillable = [
        'account_subscription_id', 'recharged_on',
    ];
    protected $dates = [
        'recharged_on',
    ];
}