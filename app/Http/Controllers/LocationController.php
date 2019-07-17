<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return response()->json($locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Récupération des inputs pertinents
        if (!$request->has([
            'city',
            'street',
            'street_number',
            'zip_code',
            'building'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $newLocation['city'] = $request->city;
        $newLocation['street'] = $request->street;
        $newLocation['street_number'] = $request->street_number;
        $newLocation['zip_code'] = $request->zip_code;
        $newLocation['building'] = $request->building;

        DB::beginTransaction();
        try {

            $validate = Location::getValidation($newLocation);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $location = Location::saveOne($newLocation);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $location;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Location::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Récupération des inputs pertinents
        if (!$request->has([
            'city',
            'street',
            'street_number',
            'zip_code',
            'building'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $location = Location::find($id);

        if(empty($location)){
            return response()->json(['error' => 'location introuvable']);
        }

        $updatedLocation['city'] = $request->city;
        $updatedLocation['street'] = $request->street;
        $updatedLocation['street_number'] = $request->street_number;
        $updatedLocation['zip_code'] = $request->zip_code;
        $updatedLocation['building'] = $request->building;

        DB::beginTransaction();
        try {

            $validate = Location::getValidation($updatedLocation);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $location->update($updatedLocation);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $location;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();

        return $location;
    }
}