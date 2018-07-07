<?php

Route::group(['middleware' => 'web', 'prefix' => 'letter', 'namespace' => 'Modules\Letter\Http\Controllers'], function()
{
    Route::get('/', 'LetterController@index');
});
