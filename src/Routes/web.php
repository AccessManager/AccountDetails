<?php
Route::group([
    'namespace'     =>      'AccessManager\AccountDetails\Http\Controllers',
    'prefix'        =>      'accounts/{username}',
], function (){

    Route::get('/', [
        'as'    =>  'account.details',
        'uses'  =>  function(){
                        return redirect()->route('account.subscriptions', request()->segment(2));
                    }
    ]);

    Route::get('/subscriptions', [
        'as'    =>  'account.subscriptions',
        'uses'  =>  'AccountDetailsController@getSubscriptions',
    ]);

    Route::get('/demographics', [
        'as'    =>  'account.demographics',
        'uses'  =>  'AccountDetailsController@getDemographics',
    ]);

    Route::group(['prefix'=>'subscriptions'], function(){

        Route::get('/add', [
            'as'    =>  'account.subscriptions.add',
            'uses'  =>  'AccountSubscriptionsController@getAdd',
        ]);

        Route::post('/add', [
            'as'    =>  'account.subscriptions.add.post',
            'uses'  =>  'AccountSubscriptionsController@postAdd',
        ]);

        Route::get('/{username}', [
            'as'    =>  'account.subscription.details',
            'uses'  =>  'AccountSubscriptionsController@getSubDetails',
        ]);

        Route::get('/{username}/change-password', [
            'as'    =>  'account.subscription.change-password',
            'uses'  =>  'AccountSubscriptionsController@getChangePassword',
        ]);

        Route::post('/{username}/change-password', [
            'as'    =>  'account.subscription.change-password.post',
            'uses'  =>  'AccountSubscriptionsController@postChangePassword',
        ]);

    });

});