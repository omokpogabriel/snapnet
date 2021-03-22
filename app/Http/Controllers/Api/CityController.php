<?php

namespace App\Http\Controllers\Api;

use App\CustomService\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * gets all the cities in the database
     *
     * returns the cities with status 200 or 404 if no city exists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCities(){

        $countries = City::get();
        if(!$countries){
            $response = ResponseMessage::errorMessage('unable to get city');
            return $response()->json($response, 404);
        }

        $response = ResponseMessage::successMessage('city retrieved successfully', $countries);
        return response()->json($response, 200);

    }

    /**
     * Gets a city by id
     *
     *    returns the city
     *    throws a 404 if the city id does not exist else
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCity($id){
        try{
            $country = City::findOrFail($id);
            $response = ResponseMessage::successMessage('city  retrieved successfully', $country);
            return response()->json($response, 200);
        }catch( ModelNotFoundException $ex){
            $response = ResponseMessage::errorMessage('unable to get city with id:'. $id);
            return response()->json($response, 404);
        }

    }

    /**
     *
     *    returns the city with the id, along side the state and country
     *    throws a 404 if the city id does not exist else
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFullInfo($id){

        $country = City::where('id',$id)->with('state');
        if($country->count() != 0){

            $response = ResponseMessage::successMessage('country  retrieved successfully', $country->get());
            return response()->json($response, 200);
        }else{
            $response = ResponseMessage::errorMessage('unable to get countries with id:'. $id);
            return response()->json($response, 404);
        }
    }
}
