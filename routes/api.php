 <?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('v1/spaces', function (Request $request) {
    return $request();
});

/*	Routes for Space Model */
Route::get('v1/spaces', 'SpaceController@index');
Route::post('v1/space', 'SpaceController@storeFull');
Route::get('v1/spaces/stats', 'SpaceController@statistics');
Route::get('v1/space/{space}', 'SpaceController@indexOne');
Route::put('v1/space/{id}', 'SpaceController@storeWithId');
Route::patch('v1/space/{space}', 'SpaceController@update');
Route::delete('v1/space/{space}', 'SpaceController@destroy');

/*	Routes for Efiewura Model */
Route::get('v1/efiewuras', 'EfiewuraController@index');
Route::post('v1/efiewura', 'EfiewuraController@store');
Route::get('v1/efiewura/{efiewura}', 'EfiewuraController@indexOne');
Route::put('v1/efiewura/{id}', 'EfiewuraController@storeWithId');
Route::patch('v1/efiewura/{efiewura}', 'EfiewuraController@update');
Route::delete('v1/efiewura/{efiewura}', 'EfiewuraController@destroy');

/*	Routes for Location Model */
Route::get('v1/locations', 'LocationController@index');
Route::post('v1/location', 'LocationController@store');
Route::get('v1/location/{location}', 'LocationController@indexOne');
Route::put('v1/location/{id}', 'LocationController@storeWithId');
Route::patch('v1/location/{location}', 'LocationController@update');
Route::delete('v1/location/{location}', 'LocationController@destroy');

/*	Routes for Photo Model */
Route::get('v1/photos', 'PhotoController@index');
Route::post('v1/photo', 'PhotoController@store');
Route::get('v1/photo/{photo}', 'PhotoController@indexOne');
Route::put('v1/photo/{id}', 'PhotoController@storeWithId');
Route::patch('v1/photo/{photo}', 'PhotoController@update');
Route::delete('v1/photo/{photo}', 'PhotoController@destroy');

/*	Routes for Session Model */
Route::get('v1/sessions', 'SessionController@index');
Route::post('v1/session', 'SessionController@store');
Route::get('v1/session/{session}', 'SessionController@indexOne');
Route::put('v1/session/{id}', 'SessionController@storeWithId');
Route::patch('v1/session/{session}', 'SessionController@update');
Route::delete('v1/session/{session}', 'SessionController@destroy');

/*	Routes for Tag Model */
Route::get('v1/tags', 'TagController@index');
Route::post('v1/tag', 'TagController@store');
Route::get('v1/tag/{tag}', 'TagController@indexOne');
Route::put('v1/tag/{id}', 'TagController@storeWithId');
Route::patch('v1/tag/{tag}', 'TagController@update');
Route::delete('v1/tag/{tag}', 'TagController@destroy');

/* Search */
Route::get('v1/spaces/search', 'SpaceController@search');
Route::get('v1/spaces/{filter}/search', 'SpaceController@searchByFilter');
Route::get('v1/tags/search', 'TagController@search');
Route::get('v1/tags/town/search', 'TagController@townSearch');