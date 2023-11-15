<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => "\EmizorIpx\ManyContacts\Http\Controllers\Api", 'prefix' => 'manycontacts'], function () {

    Route::post('callback', 'CallbackController@callback');


});

