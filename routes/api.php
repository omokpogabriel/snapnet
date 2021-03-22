<?php

use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix'=>'v1'], function(){

        Route::group(['prefix'=>'/countries'], function(){
            Route::get('/', [CountryController::class, 'getAllCountries'])->name('allCountries');
            Route::get('/{id}', [CountryController::class, 'getCountry'])->name('country');
            Route::get('/{id}/withstates', [CountryController::class, 'getCountryWithState'])->name('country_state');

        });

        Route::group(['prefix'=>'/states'], function(){
            Route::get('/', [StateController::class, 'getAllStates'])->name('allStates');
            Route::get('/{id}', [StateController::class, 'getState'])->name('state');
            Route::get('/{id}/withcountry', [StateController::class, 'getStateWithCountry'])->name('state_country');
        });

        Route::group(['prefix'=>'/cities'], function(){
            Route::get('/', [CityController::class, 'getAllCities'])->name('allCities');
            Route::get('/{id}', [CityController::class, 'getCity'])->name('City');
            Route::get('/{id}/withstateandCountry', [CityController::class, 'getFullInfo'])->name('city_state_country');
        });

        Route::group(['prefix'=> '/assets'], function(){
           Route::get('/', [AssetController::class,'index']);
           Route::post('/', [AssetController::class,'store']);
           Route::get('/{id}', [AssetController::class,'show']);
           Route::post('/groups/addassetGroup', [AssetController::class,'createGroup']);
           Route::post('/users/addassetUser', [AssetController::class,'createUser']);
           Route::get('/groups/{id}', [AssetController::class,'listGroup']);
        });
   });
