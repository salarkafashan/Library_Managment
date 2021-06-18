<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AgeRequest;
use App\Http\Resources\V1\AgeResource;
use App\Http\Resources\V1\AgeResourceCollection;
use App\Models\Age;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $age = Age::all();
        return new AgeResourceCollection($age);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgeRequest $request)
    {
        $validated = $request->validated();
        $age = Age::create($validated);
        return new AgeResource($age);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $age = Age::findOrFail($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['errors'=>'Age Not Found'],Response::HTTP_NOT_FOUND);
        }
        return new AgeResource($age);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgeRequest $request, $id)
    {
        try{
            $age = Age::findOrFail($id);
            $validated = $request->validated();
            $age->update($validated);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['errors'=>'Age Not Found'],Response::HTTP_NOT_FOUND);
        }
        return new AgeResource($age);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $age = Age::findOrFail($id);
            $age->delete();
        }
        catch (ModelNotFoundException $e) {

            return response()->json(['errors'=>'age Not Found'],Response::HTTP_NOT_FOUND);
        }
        
        return response()->json(['message'=>'successfully deleted']);
    }
}
