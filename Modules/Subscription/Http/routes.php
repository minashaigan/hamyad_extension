<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Subscription\Http\Controllers'], function() {

    Route::get('subscriptions', 'SubscriptionController@index');
});
