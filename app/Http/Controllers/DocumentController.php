<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();
        return response()->json($documents);
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
            'name'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $newDocument['name'] = $request->name;

        DB::beginTransaction();
        try {

            $validate = Document::getValidation($newDocument);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $document = Abonnement::saveOne($newDocument);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $document;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Document::find($id));
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
            'name'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $document = Document::find($id);

        if(empty($document)){
            return response()->json(['error' => 'document introuvable']);
        }

        $updatedDocument['name'] = $request->name;

        DB::beginTransaction();
        try {

            $validate = Document::getValidation($updatedDocument);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $document->update($updatedDocument);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $document;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        $document->delete();

        return $document;
    }
}
