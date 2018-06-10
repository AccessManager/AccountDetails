<?php

namespace AccessManager\AccountDetails\AccountSubscription\Models;


use AccessManager\AccountDetails\AccountSubscription\Interfaces\AccountSubscriptionInterface;
use AccessManager\AccountDetails\AccountSubscription\Interfaces\SubscriptionInterface;
use AccessManager\Accounts\Models\Account;
use AccessManager\Base\Models\AdminBaseModel;
use AccessManager\Constants\Subscription;
use Carbon\Carbon;

/**
 * Class AccountSubscription
 * @package AccessManager\AccountDetails
 */
class AccountSubscription extends AdminBaseModel implements SubscriptionInterface
{
    /**
     * here we define what parameters are allowed to be inserted into database.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'type', 'username', 'password', 'name',
        'sim_sessions', 'interim_updates', 'expires_on', 'status',
    ];

    /**
     * here we define the name of the corresponding table.
     *
     * @var string
     */
    protected $table = 'account_subscriptions';

    protected $dates = [
        'expires_on',
    ];

    /**
     * define relationship with limits related to account subscription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function limits()
    {
        return $this->hasOne( AccountSubscriptionLimit::class, 'account_subscription_id' );
    }

    /**
     * Define relationship with subscription primary policy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function primaryPolicy()
    {
        return $this->hasOne(AccountSubscriptionPrimaryPolicy::class, 'account_subscription_id');
    }

    /**
     * Define relationship with subscription services.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function services()
    {
        return $this->hasOne(AccountSubscriptionService::class, 'account_subscription_id');
    }

    /**
     * Define relationship with subscription after quota policy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aqPolicy()
    {
        return $this->hasOne(AccountSubscriptionAqPolicy::class, 'account_subscription_id');
    }

    /**
     * Defines relationship with Account model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Defines relationship with AccountSubscriptionRoute model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function route()
    {
        return $this->hasOne(AccountSubscriptionRoute::class, 'account_subscription_id');
    }

    /**
     * Checks if subscription expiration date passed.
     *
     * @return bool
     */
    public function hasExpired()
    {
        //return false if subscription have no expiry date defined.
        if( $this->expires_on == null ) return false;

        $now = new Carbon;
        return $this->expires_on < $now;
    }

    /**
     * check if quota assigned to the subscription has been fully used up
     * on limited subscription services.
     *
     * @return bool
     */
    public function quotaExhausted()
    {
        //if there are no limits assigned, return false.
        if( $this->limits == null )   return false;

        //Otherwise, if have limits assigned.
        //If quota exhausted and no after quota policy is assigned, return true;
        if( $this->services->exhausted && $this->aqPolicy == null )
            return true;

        //at this stage either quota balance is available or AQ policy is assigned. So return false;
        return false;
    }

    /**
     * check if subscription is prepaid.
     *
     * @return bool
     */
    public function isPrepaid()
    {
        return $this->type == Subscription::PREPAID;
    }

    /**
     * check if subscription is free.
     *
     * @return bool
     */
    public function isFree()
    {
        return $this->type == Subscription::FREE;
    }

    /**
     * check if subscription is postpaid.
     *
     * @return bool
     */
    public function isPostpaid()
    {
        return $this->type == Subscription::POSTPAID;
    }

    /**
     * check if subscription is advancepaid.
     *
     * @return bool
     */
    public function isAdvancepaid()
    {
        return $this->type == Subscription::ADVANCEPAID;
    }

}