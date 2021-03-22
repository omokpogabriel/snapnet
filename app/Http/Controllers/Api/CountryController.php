<?php

namespace App\Http\Controllers\Api;

use App\CustomService\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /**
     * gets all the countries in the database
     *
     * returns the countries with status 200 or 404 if no country exists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCountries(){

        $countries = Country::get();
        if(!$countries){
            $response = ResponseMessage::errorMessage('unable to get countries');
            return $response()->json($response, 404);
        }

        $response = ResponseMessage::successMessage('countries retrieved successfully', $countries);
        return response()->json($response, 200);

    }

    /**
     * Gets a country by id
     *
     *    returns the country
     *    throws a 404 if the country id does not exist else
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountry($id){
        try{
            $country = Country::findOrFail($id);
            $response = ResponseMessage::successMessage('country  retrieved successfully', $country);
            return response()->json($response, 200);
        }catch( ModelNotFoundException $ex){
            $response = ResponseMessage::errorMessage('unable to get countries with id:'. $id);
            return response()->json($response, 404);
        }

    }

    /**
     *
     *    returns the country with the state with the country id
     *    throws a 404 if the country id does not exist else
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountryWithState($id){

            $country = Country::where('id',$id)->with('state');
            if($country->count() != 0){

            $response = ResponseMessage::successMessage('country  retrieved successfully', $country->get());
            return response()->json($response, 200);
        }else{
            $response = ResponseMessage::errorMessage('unable to get countries with id:'. $id);
            return response()->json($response, 404);
        }
    }
}
