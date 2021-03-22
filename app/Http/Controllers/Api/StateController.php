<?php

namespace App\Http\Controllers\Api;

use App\CustomService\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateController extends Controller
{

    /**
     * gets all the States in the database
     *
     * returns the States with status 200 or 404 if no country exists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStates(){

        $countries = State::get();
        if(!$countries){
            $response = ResponseMessage::errorMessage('unable to get states');
            return $response()->json($response, 404);
        }

        $response = ResponseMessage::successMessage('states retrieved successfully', $countries);
        return response()->json($response, 200);

    }

    /**
     * Gets a country by id
     *
     *    returns the a state
     *    throws a 404 if the state id does not exist else
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getState($id){
        try{
            $country = State::findOrFail($id);
            $response = ResponseMessage::successMessage('state  retrieved successfully', $country);
            return response()->json($response, 200);
        }catch( ModelNotFoundException $ex){
            $response = ResponseMessage::errorMessage('unable to get state with id:'. $id);
            return response()->json($response, 404);
        }

    }

    /**
     *
     *    returns the state  with the state id  and the parent country
     *    throws a 404 if the country id does not exist else
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStateWithCountry($id){

            $country = State::where('id',$id)->with('country');

            if($country->count() != 0){
                $response = ResponseMessage::successMessage('state with country  retrieved successfully', $country->get());
                return response()->json($response, 200);
            }else{
            $response = ResponseMessage::errorMessage('unable to get state with id:'. $id);
            return response()->json($response, 404);
             }
    }
}
