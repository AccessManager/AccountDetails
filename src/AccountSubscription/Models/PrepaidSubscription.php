<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\AccountDetails\AccountSubscription\Interfaces\AccountSubscriptionInterface;
use AccessManager\Constants\Subscription;
use AccessManager\Prepaid\Models\Voucher;

class PrepaidSubscription extends AccountSubscription implements AccountSubscriptionInterface
{
    /**
     * Defines relationship with PrepaidSubscriptionSetting model.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function settings()
    {
        return $this->hasOne(PrepaidSubscriptionSetting::class, 'prepaid_subscription_id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'used_by');
    }

    public function __construct()
    {
        parent::__construct();
        static::addGlobalScope(function($query){
            return $query->where('type', Subscription::PREPAID);
        });
    }
}