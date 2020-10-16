<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/', 'middleware' => 'ValidationXML'], function () {
    Route::group(['prefix' => '/', 'middleware' => 'ServiceTransformer'], function () {
        Route::post('message', 'AnswerMessageController');
    });
});
