<?php

namespace AccessManager\AccountDetails\AccountDetails\Http\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;
use AccessManager\Constants\Subscription;
use Illuminate\Validation\Rule;

class AddSubscriptionRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'  =>      ['required', 'unique:account_subscriptions'],
            'password'  =>      ['required'],
            'type'      =>      [
                'required',
                Rule::in(Subscription::SUBSCRIPTION_TYPES)
            ],
        ];
    }
}