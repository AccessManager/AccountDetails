<?php

namespace AccessManager\AccountDetails\Libraries;


use AccessManager\AccountDetails\AccountSubscription\Models\FreeSubscription;
use AccessManager\Services\Plans\Models\ServicePlan;
use Illuminate\Support\Facades\DB;
use DateTime;

class FreeSubscriptionPlanAssignmentHandler extends ServicePlanAssignmentAbstractService
{
    /**
     * @var FreeSubscription
     */
    protected $subscription;

    /**
     * @var ServicePlan
     */
    protected $plan;

    /**
     * @var DateTime
     */
    protected $expiresOn;

    public function process()
    {
        DB::transaction(function(){
            $this->setSubscription($this->subscription);
            $this->setServiceContainer($this->plan);
            $this->assignServices();
        });
    }

    /**
     * If applied, updates subscription expiration date and time.
     */
    protected function updateExpiry()
    {
        if( $this->expiresOn == null )  return;
        if( is_string($this->expiresOn) )
        {
            $this->expiresOn = new DateTime($this->expiresOn);
        }
        $this->subscription->expires_on = $this->expiresOn->format('Y-m-d H:i:s');
    }

    /**
     * FreeSubscriptionPlanAssignmentHandler constructor.
     * @param FreeSubscription $subscription
     * @param ServicePlan $plan
     * @param DateTime $expiresOn
     */
    public function __construct( FreeSubscription $subscription, ServicePlan $plan, $expiresOn = null )
    {
        $this->subscription = $subscription;
        $this->plan = $plan;
        $this->expiresOn = $expiresOn;
    }
}