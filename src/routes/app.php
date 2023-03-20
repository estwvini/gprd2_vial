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
])->prefix('app')->group(function () {

    Route::get('/faqs/data', 'App\FaqController@data')->name('data.index.faqs');
    Route::put('/faqs/publish/{faq}', 'App\FaqController@publish')->name('publish.faqs');

    Route::resource('faqs', 'App\FaqController', [
        'parameters' => ['faq' => 'id'],
        'names' => [
            'index' => 'index.faqs',
            'create' => 'create.faqs',
            'store' => 'store.create.faqs',
            'edit' => 'edit.faqs',
            'update' => 'update.edit.faqs',
            'destroy' => 'destroy.faqs'
        ]
    ])->except('show');

    Route::get('/subjects/data', 'App\SubjectController@data')->name('data.index.subjects');

    Route::resource('subjects', 'App\SubjectController', [
        'parameters' => ['subject' => 'id'],
        'names' => [
            'index' => 'index.subjects',
            'create' => 'create.subjects',
            'store' => 'store.create.subjects',
            'edit' => 'edit.subjects',
            'update' => 'update.edit.subjects',
            'destroy' => 'destroy.subjects'
        ]
    ])->except('show');

    Route::get('/reviews/data', 'App\ReviewController@data')->name('data.index.reviews');
    Route::get('/reviews/create/{review}', 'App\ReviewController@create')->name('create.reviews');
    Route::post('/reviews/{review}', 'App\ReviewController@store')->name('store.create.reviews');

    Route::resource('reviews', 'App\ReviewController', [
        'parameters' => ['reviews' => 'id'],
        'names' => [
            'index' => 'index.reviews',
            'edit' => 'edit.reviews',
            'update' => 'update.edit.reviews',
            'destroy' => 'destroy.reviews'
        ]
    ])->except('show', 'create', 'update');


    Route::get('/approvals', 'App\ApprovalController@index')->name('approvals.reviews');
    Route::get('/approvals/edit/{review}', 'App\ApprovalController@edit')->name('edit.approvals.reviews');
    Route::put('/approvals/update/{review}', 'App\ApprovalController@update')->name('update.edit.approvals.reviews');
    Route::get('/approvals/data', 'App\ApprovalController@data')->name('data.approvals.reviews');
    Route::put('/approvals/approve', 'App\ApprovalController@bulkApprove')->name('approve.approvals.reviews');

    Route::post('/history/db', 'App\HistoryController@import')->name('import.history');

});
