<?php

Route::group([
    'namespace' =>  'AccessManager\AccountDetails\AccountSubscription\Http\Controllers',
    'middleware'    =>      'auth',
], function(){

    Route::group([
        'prefix'    => 'accounts/{accountUsername}/prepaid-subscriptions/{subscriptionUsername}',
    ], function(){

        Route::get('/', [
            'as'    =>  'account.subscriptions.prepaid',
            'uses'  =>  function(){
                return redirect()->route(
                    'account.subscriptions.prepaid.services',
                    [request()->segment(2), request()->segment(4)]
                    );
            },
        ]);

        Route::get('/services', [
            'as'    =>  'account.subscriptions.prepaid.services',
            'uses'  =>  'PrepaidSubscriptionController@getServices',
        ]);

        Route::get('/session-history', [
            'as'    =>  'account.subscriptions.prepaid.session-history',
            'uses'  =>  'PrepaidSubscriptionController@getSessionHistory',
        ]);

        Route::get('/recharge-history', [
            'as'    =>  'account.subscriptions.prepaid.recharge-history',
            'uses'  =>  'PrepaidSubscriptionController@getRechargeHistory',
        ]);

        Route::get('/change-password', [
            'as'    =>  'account.subscriptions.prepaid.change-password',
            'uses'  =>  'PrepaidSubscriptionController@getChangePassword',
        ]);

        Route::post('/change-password', [
            'as'    =>  'account.subscriptions.prepaid.change-password.post',
            'uses'  =>  'PrepaidSubscriptionController@postChangePassword',
        ]);

        Route::get('/network-config', [
            'as'    =>  'account.subscriptions.prepaid.network-config',
            'uses'  =>  'PrepaidSubscriptionController@getNetworkConfig',
        ]);

        Route::post('/assign-ip', [
            'as'    =>  'accounts.subscriptions.prepaid.assign-ip.post',
            'uses'  =>  'PrepaidSubscriptionController@postAssignFramedIp',
        ]);
    });

    Route::group([
        'prefix'    =>  'accounts/{accountUsername}/free-subscriptions/{subscriptionUsername}',
    ], function(){

        Route::get('/', [
            'as'    =>  'account.subscriptions.free',
            'uses'  =>  function(){
                return redirect()->route('account.subscriptions.free.services',
                    [request()->segment(2), request()->segment(4)]
                );
            },
        ]);

        Route::get('/services', [
            'as'    =>  'account.subscriptions.free.services',
            'uses'  =>  'FreeSubscriptionController@getServices',
        ]);

        Route::get('/session-history', [
            'as'    =>  'account.subscriptions.free.session-history',
            'uses'  =>  'FreeSubscriptionController@getSessionHistory',
        ]);

        Route::get('/change-password', [
            'as'    =>  'account.subscriptions.free.change-password',
            'uses'  =>  'FreeSubscriptionController@getChangePassword',
        ]);

        Route::post('/change-password', [
            'as'    =>  'account.subscriptions.free.change-password.post',
            'uses'  =>  'FreeSubscriptionController@postChangePassword',
        ]);

        Route::get('assign-services', [
            'as'    =>  'account.subscriptions.free.assign-services',
            'uses'  =>  'FreeSubscriptionController@getAssignServices',
        ]);

        Route::post('assign-services', [
            'as'    =>  'account.subscriptions.free.assign-services.post',
            'uses'  =>  'FreeSubscriptionController@postAssignServices',
        ]);

        Route::get('flip-status', [
            'as'    =>  'account.subscriptions.free.flip-status',
            'uses'  =>  'FreeSubscriptionController@getFlipStatus',
        ]);

        Route::get('/network-config', [
            'as'    =>  'account.subscriptions.free.network-config',
            'uses'  =>  'FreeSubscriptionController@getNetworkConfig',
        ]);

        Route::get('/network-config/assign-ip', [
            'as'    =>  'account.subscriptions.free.assign-ip',
            'uses'  =>  'FreeSubscriptionController@getAssignIp'
        ]);

        Route::post('/network-config/assign-ip', [
            'as'    =>  'account.subscriptions.free.assign-ip.post',
            'uses'  =>  'FreeSubscriptionController@postAssignIp',
        ]);

        Route::post('/network-config/remove-ip', [
            'as'    =>  'account.subscriptions.free.remove-ip.post',
            'uses'  =>  'FreeSubscriptionController@postRemoveIp'
        ]);

        Route::get('/network-config/assign-route', [
            'as'    =>  'account.subscriptions.free.assign-route',
            'uses'  =>  'FreeSubscriptionController@getAssignRoute',
        ]);

        Route::post('/network-config/assign-route', [
            'as'    =>  'account.subscriptions.free.assign-route.post',
            'uses'  =>  'FreeSubscriptionController@postAssignRoute',
        ]);

        Route::post('/network-config/remove-route', [
            'as'    =>  'account.subscriptions.free.remove-route.post',
            'uses'  =>  'FreeSubscriptionController@postRemoveRoute',
        ]);
    });

});