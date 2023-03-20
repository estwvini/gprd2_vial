<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([
    'web',
    'auth',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

//falta datos en el registro
    Route::post('register', 'App\Api\ClientController@register');
    Route::post('loginclientes', 'App\Api\ClientController@login');
    Route::get('profile/{id}', 'App\Api\ClientController@profile');

    Route::get('settings', 'App\Api\SettingController@index');

//forgotPassword
    Route::post('createPasswordReset', 'App\Api\PasswordResetController@createPasswordReset');
    Route::get('find/{token}', 'App\Api\PasswordResetController@find');
    Route::post('reset', 'App\Api\PasswordResetController@reset');

//Route::post('forgotPassword', 'App\Api\ClientController@forgotPassword');
    Route::post('login', 'App\Api\UserController@login');
    Route::get('locations', 'App\Api\CantonController@index');

    Route::group(['prefix' => 'user', 'middleware' => ['auth:api-web']], function () {
        Route::get('budget-locations', 'App\Api\LocationController@index');
        Route::get('budget-indicators', 'App\Api\BudgetIndicatorController@index');
        Route::get('visitClient/{date}', 'App\Api\VisitClientController@getVisit');
        Route::get('groupClient', 'App\Api\VisitClientController@getGroupClients');
        Route::get('locationsGroupClient', 'App\Api\CantonController@getGroupClientsCanton');
        Route::get('reviewsDetails', 'App\Api\ReviewController@reviewsDetails');
        Route::get('departments', 'App\Api\DepartmentController@index');
        Route::get('projects', 'App\Api\ProjectController@index');
        Route::get('projects/{project}', 'App\Api\ProjectController@show');
        Route::get('clients-gender', 'App\Api\VisitClientController@getClientGender');
    });

    Route::group(['prefix' => 'client', 'middleware' => ['auth:api-client']], function () {
        Route::get('reviews', 'App\Api\ReviewController@index');
        Route::post('reviews', 'App\Api\ReviewController@store');
        Route::get('subjects', 'App\Api\SubjectController@index');
        Route::get('faqs', 'App\Api\FaqController@index');
        Route::post('change/{id}', 'App\Api\ClientController@change');
        Route::get('departments', 'App\Api\DepartmentController@index');
        Route::get('projects', 'App\Api\ProjectController@index');
        Route::get('projects/{project}', 'App\Api\ProjectController@show');
    });

});
