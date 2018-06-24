<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\Base\Models\AdminBaseModel;

class AccountSubscriptionRoute extends AdminBaseModel
{
    protected $fillable = [
        'account_subscription_id', 'cidr', 'assigned_on',
    ];
    protected $dates = ['assigned_on'];
    public $timestamps = false;

    public function subscription()
    {
        return $this->belongsTo(AccountSubscription::class, 'account_subscription_id');
    }
}