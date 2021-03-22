<?php

namespace App\Http\Controllers\Api;

use App\CustomService\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Asset::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = validator($request->all(),[
           'type' => ['required','string','min:2']
        ]);

        if($validate->fails()){
            $response = ResponseMessage::errorMessage("unable to add new asset");
            return response()->json($response, 401);
        }

        $asset = Asset::create([
           'type' => $request->type
        ]);

        $response = ResponseMessage::successMessage("asset created successfully",$asset);
        return response()->json($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::where('id', $id)->with('assetGroup')->with('assetUser')->get();

        if(!$asset){
            $response = ResponseMessage::errorMessage("asset not found");
            return response()->json($response);
        }


        $response = ResponseMessage::successMessage("asset found", $asset);
        return response()->json($response);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * create new asset group
     */
    public function createGroup(Request $request){

        $validate = validator($request->all(),[
            'asset_id' => ['required'],
            'name' => ['required','string','min:2']
        ]);

        if($validate->fails()){
            $response = ResponseMessage::errorMessage("unable to add new asset group");
            return response()->json($response, 401);
        }

        try{
            $asset = Asset::where('id',$request->asset_id)->first()
                ->assetGroup()->create([
                    'name' => $request->name,
                ]);
            $response = ResponseMessage::successMessage("asset created successfully",$asset);
            return response()->json($response);
        }catch(ModelNotFoundException $ex){

        }


    }

    public function createUser(Request $request){

        $validate = validator($request->all(),[
            'asset_id' => ['required'],
            'name' => ['required','string','min:2']
        ]);

        if($validate->fails()){
            $response = ResponseMessage::errorMessage("unable to add new asset user");
            return response()->json($response, 401);
        }

        try{
            $asset = Asset::where('id',$request->asset_id)->first()
                ->assetUser()->create([
                    'name' => $request->name,
                ]);
            $response = ResponseMessage::successMessage("asset user created successfully",$asset);
            return response()->json($response);
        }catch(ModelNotFoundException $ex){

        }


    }
}
