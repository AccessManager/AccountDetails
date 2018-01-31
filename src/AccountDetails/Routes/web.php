<?php
Route::group([
    'namespace'     =>      'AccessManager\AccountDetails\AccountDetails\Http\Controllers',
    'prefix'        =>      'accounts/{username}',
    'middleware'    =>      'auth',
], function (){

    Route::get('/', [
        'as'    =>  'account.details',
        'uses'  =>  function(){
                        return redirect()->route('account.subscriptions', request()->segment(2));
                    }
    ]);

    Route::get('/demographics', [
        'as'    =>  'account.demographics',
        'uses'  =>  'AccountDetailsController@getDemographics',
    ]);

    Route::get('/subscriptions', [
        'as'    =>  'account.subscriptions',
        'uses'  =>  'AccountDetailsController@getSubscriptions',
    ]);

    Route::get('/subscriptions/add', [
        'as'    =>  'account.subscriptions.add',
        'uses'  =>  'AccountDetailsController@getAddSubscription',
    ]);

    Route::post('/subscriptions/add', [
        'as'    =>  'account.subscriptions.add.post',
        'uses'  =>  'AccountDetailsController@postAddSubscription',
    ]);

    Route::get('/change-password', [
        'as'    =>  'account.change-password',
        'uses'  =>  'AccountDetailsController@getChangePassword',
    ]);

    Route::post('/change-password', [
        'as'    =>  'account.change-password.post',
        'uses'  =>  'AccountDetailsController@postChangePassword',
    ]);

});