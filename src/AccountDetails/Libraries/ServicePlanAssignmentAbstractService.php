<?php

namespace AccessManager\AccountDetails\Libraries;


use AccessManager\AccountDetails\AccountSubscription\Interfaces\AccountSubscriptionInterface;
use AccessManager\Services\Interfaces\ContainsSubscriptionServicesInterface;
use AccessManager\Services\Plans\Models\ServicePlan;
use AccessManager\Constants\Data;
use AccessManager\Constants\Time;

abstract class ServicePlanAssignmentAbstractService
{
    /**
     * @var ServicePlan
     */
    protected $services;

    /**
     * @var AccountSubscriptionInterface
     */
    protected $subscription;

    protected abstract function updateExpiry();
    public abstract function process();

    protected function assignServices()
    {
        $this->subscription->fill([
            'name' =>  $this->services->name,
            'sim_sessions'  =>  $this->services->sim_sessions,
            'interim_updates'   =>  $this->services->interim_updates,
        ]);
        $this->updateExpiry();

        $this->subscription->saveOrFail();

        $this->updatePrimaryPolicy();
        $this->updateLimits();
        $this->updateAqPolicy();
        $this->updateQuotaBalance();
    }

    /**
     * Takes care of updating primary bandwidth policy for the subscription.
     */
    protected function updatePrimaryPolicy()
    {
        if( $this->services->primaryPolicy == null  )
        {
            $this->subscription->primaryPolicy()->delete();
        } else {
            $this->subscription->primaryPolicy()->updateOrCreate(
                [],
                $this->services->primaryPolicy->toArray()
            );
        }
    }
    
    /**
     * Takes care of updating quota limits for the subscription.
     */
    protected function updateLimits()
    {
        if ( $this->services->limits == null )
        {
            $this->subscription->limits()->delete();
        } else {
            $this->subscription->limits()->updateOrCreate(
                [],
                $this->services->limits->toArray()
            );
        }
    }

    /**
     * Takes care of updating after quota bandwidth policy for the subscription.
     */
    protected function updateAqPolicy()
    {
        if( $this->services->aqPolicy == null )
        {
            $this->subscription->aqPolicy()->delete();
        } else {
            $this->subscription->aqPolicy()->updateOrCreate(
                [],
                $this->services->aqPolicy->toArray()
            );
        }
    }

    /**
     * Takes care of updating quota balance for the subscription.
     */
    protected function updateQuotaBalance()
    {
        if ($this->services->limits == null )
        {
            return $this->subscription->services()->delete();
        }

        $quota = $this->subscription->services()->updateOrCreate([
            'account_subscription_id' =>  $this->subscription->id,
        ]);

        if( is_integer($this->services->limits->time_limit) )
        {
            $quota->time_balance = $this->services->limits->time_limit * Time::getUnitValue($this->services->limits->time_unit);
        }

        if( is_integer($this->services->limits->data_limit) )
        {
            $quota->data_balance = $this->services->limits->data_limit * Data::getUnitValue($this->services->limits->data_unit);
        }

        $quota->save();
    }

    /**
     * @param AccountSubscriptionInterface $subscription
     */
    protected function setSubscription( AccountSubscriptionInterface $subscription )
    {
        $this->subscription = $subscription;
    }

    /**
     * @param ContainsSubscriptionServicesInterface $services
     */
    protected function setServiceContainer(ContainsSubscriptionServicesInterface $services )
    {
        $this->services = $services;
    }

//    /**
//     * ServicePlanAssignmentAbstractService constructor.
//     * @param ServicePlan $services
//     * @param AccountSubscriptionInterface $subscription
//     */
//    public function __construct( ServicePlan $services, AccountSubscriptionInterface $subscription )
//    {
//        $this->services = $services;
//        $this->subscription = $subscription;
//    }
}