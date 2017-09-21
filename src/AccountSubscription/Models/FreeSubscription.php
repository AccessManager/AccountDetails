<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\AccountDetails\AccountSubscription\Interfaces\AccountSubscriptionInterface;

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
}