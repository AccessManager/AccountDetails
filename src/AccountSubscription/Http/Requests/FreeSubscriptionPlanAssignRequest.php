<?php

namespace AccessManager\AccountDetails\AccountSubscription\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;

class FreeSubscriptionPlanAssignRequest extends BaseFormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'expires_on'    =>  ['date'],
        ];
    }
}