<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\AccountDetails\AccountSubscription\Interfaces\AccountSubscriptionInterface;
use AccessManager\Constants\Subscription;

class FreeSubscription extends AccountSubscription implements AccountSubscriptionInterface
{
    /**
     * since we do not have any separate settings for free subscriptions,
     * we simply throw an Exception.
     * @throws \Exception
     */
    public function settings()
    {
        throw new \Exception("No separate settings for Free Subscriptions.");
    }

    public function __construct()
    {
        parent::__construct();
        static::addGlobalScope(function($query){
            return $query->where('type', Subscription::FREE);
        });
    }
}