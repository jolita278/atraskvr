<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['prefix' => '{lang?}'], function () {
//    Route::get('/frontend', ['as' => 'app.frontEnd.index', 'uses' => 'FrontEndController@index']);
//});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'NotAdminRestriction']], function () {
    Route::get('/', ['as' => 'app.categories.index', 'uses' => 'VrCategoriesController@adminIndex']);


    Route::group(['prefix' => 'menu'], function () {

        Route::get('/', ['as' => 'app.menu.index', 'uses' => 'VrMenuController@adminIndex']);
        Route::get('/create', ['as' => 'app.menu.create', 'uses' => 'VrMenuController@adminCreate']);
        Route::post('/create', ['uses' => 'VrMenuController@adminStore']);

        Route::group(['prefix' => '{id}'], function () {

            Route::get('/', ['as' => 'app.menu.show', 'uses' => 'VrMenuController@adminShow']);
            Route::get('/edit/{lang?}', ['as' => 'app.menu.edit', 'uses' => 'VrMenuController@adminEdit']);
            Route::post('/edit/{lang?}', ['uses' => 'VrMenuController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.menu.destroy', 'uses' => 'VrMenuController@adminDestroy']);
        });

    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'app.orders.index', 'uses' => 'VrOrderController@adminIndex']);
        Route::get('/create', ['as' => 'app.orders.create', 'uses' => 'VrOrderController@adminCreate']);
        Route::post('/create', ['uses' => 'VrOrderController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.orders.show', 'uses' => 'VrOrderController@adminShow']);
            Route::get('/edit', ['as' => 'app.orders.edit', 'uses' => 'VrOrderController@adminEdit']);
            Route::post('/edit', ['uses' => 'VrOrderController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.orders.destroy', 'uses' => 'VrOrderController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'resources'], function () {
        Route::get('/', ['as' => 'app.resources.index', 'uses' => 'VrResourcesController@adminIndex']);
        Route::get('/create', ['as' => 'app.resources.create', 'uses' => 'VrResourcesController@adminCreate']);
        Route::post('/create', ['uses' => 'VrResourcesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.resources.show', 'uses' => 'VrResourcesController@adminShow']);
            Route::get('/edit', ['as' => 'app.resources.edit', 'uses' => 'VrResourcesController@adminEdit']);
            Route::post('/edit', ['uses' => 'VrResourcesController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.resources.destroy', 'uses' => 'VrResourcesController@adminDestroy']);
        });
    });

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', ['as' => 'app.pages.index', 'uses' => 'VrPagesController@adminIndex']);
        Route::get('/create', ['as' => 'app.pages.create', 'uses' => 'VrPagesController@adminCreate']);
        Route::post('/create', ['uses' => 'VrPagesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.pages.show', 'uses' => 'VrPagesController@adminShow']);
            Route::get('/edit', ['as' => 'app.pages.edit', 'uses' => 'VrPagesController@adminEdit']);
            Route::post('/edit', ['uses' => 'VrPagesController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.pages.destroy', 'uses' => 'VrPagesController@adminDestroy']);
        });
    });
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', ['as' => 'app.languages.index', 'uses' => 'VrLanguageCodesController@adminIndex']);
        Route::get('/create', ['as' => 'app.languages.create', 'uses' => 'VrLanguageCodesController@adminCreate']);
        Route::post('/create', ['uses' => 'VrLanguageCodesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.languages.show', 'uses' => 'VrLanguageCodesController@adminShow']);
            Route::get('/edit', ['as' => 'app.languages.edit', 'uses' => 'VrLanguageCodesController@adminEdit']);
            Route::post('/edit', ['uses' => 'VrLanguageCodesController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.languages.destroy', 'uses' => 'VrLanguageCodesController@adminDestroy']);
        });
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', ['as' => 'app.categories.index', 'uses' => 'VrCategoriesController@adminIndex']);
        Route::get('/create', ['as' => 'app.categories.create', 'uses' => 'VrCategoriesController@adminCreate']);
        Route::post('/create', ['uses' => 'VrCategoriesController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.categories.show', 'uses' => 'VrCategoriesController@adminShow']);
            Route::get('/edit', ['as' => 'app.categories.edit', 'uses' => 'VrCategoriesController@adminEdit']);
            Route::post('/edit', ['uses' => 'VrCategoriesController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.categories.destroy', 'uses' => 'VrCategoriesController@adminDestroy']);
        });
    });


    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'app.users.index', 'uses' => 'VrUsersController@adminIndex']);
        Route::get('/create', ['as' => 'app.users.create', 'uses' => 'VrUsersController@adminCreate']);
        Route::post('/create', ['uses' => 'VrUsersController@adminStore']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.users.show', 'uses' => 'VrUsersController@adminShow']);
            Route::get('/edit', ['as' => 'app.users.edit', 'uses' => 'VrUsersController@adminEdit']);
            Route::post('/edit', ['uses' => 'VrUsersController@adminUpdate']);
            Route::delete('/delete', ['as' => 'app.users.destroy', 'uses' => 'VrUsersController@adminDestroy']);

            Route::get('/orders', ['as' => 'app.users.orders', 'uses' => 'VrUsersController@orderIndex']);
        });
    });
});

//Route::group(['prefix' => '{lang}', 'middleware' => ['language']], function (){
//
//    Route::get('/', ['as' => 'app.frontEnd.index', 'uses' => 'FrontEndController@index']);
//});