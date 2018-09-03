<?php


Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {

        return view('LaravelSimpleSetup::welcome');
    });


Route::get('/setup', [
    'uses' => 'rowo\LaravelSimpleSetup\SetupController@viewStep1'
]);



Route::post('/setup/step-2', [
    'as' => 'setupStep1', 'uses' => 'rowo\LaravelSimpleSetup\SetupController@setupStep1'
]);

Route::post('/setup/testDB', [
    'as' => 'testDB', 'uses' => 'rowo\LaravelSimpleSetup\TestDbController@testDB'
]);

Route::get('/setup/step-2', [
    'uses' => 'rowo\LaravelSimpleSetup\SetupController@viewStep2'
]);

Route::get('/setup/step-3', [
    'uses' => 'rowo\LaravelSimpleSetup\SetupController@viewStep3'
]);

Route::get('/setup/step-4', [
    'uses' => 'rowo\LaravelSimpleSetup\SetupController@viewStep4'
]);

Route::get('/setup/finish', function () {

    return view('rowo\LaravelSimpleSetup\views\setup.finishedSetup');
});

Route::get('/setup/getNewAppKey', [
    'as' => 'getNewAppKey', 'uses' => 'rowo\LaravelSimpleSetup\SetupController@getNewAppKey'
]);

Route::post('/setup/step-3', [
    'as' => 'setupStep2', 'uses' => 'rowo\LaravelSimpleSetup\SetupController@setupStep2'
]);

Route::post('/setup/step-4', [
    'as' => 'setupStep3', 'uses' => 'rowo\LaravelSimpleSetup\SetupController@setupStep3'
]);

Route::post('/setup/lastStep', [
    'as' => 'lastStep', 'uses' => 'rowo\LaravelSimpleSetup\SetupController@lastStep'
]);

Route::get('setup/lastStep', function () {


    return redirect( '/setup', 301);
});

});
