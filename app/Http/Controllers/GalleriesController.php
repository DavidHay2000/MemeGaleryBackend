<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\User;
use Illuminate\Http\Request;


class GalleriesController extends Controller
{
    public function getGalleriesByUser($userID)
    {
        $user = User::find($userID);
        $galleries = $user->galleries;
        if ($galleries!= null) {
            return response()->json($galleries);
        }
        return response()->json(['message' => 'Not found'], 404);
        
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Galleries::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gallery = Galleries::create($request->all());
        return response()->json(['gallery' => $gallery], 201);
    }

     /**
     * Display the specified resource.
     */
    public function show($galleries)
    {
        $gallery = Galleries::find($galleries);
        if ($gallery!= null) {
            return $gallery;
        }
        return response()->json(['message' => 'Not found'], 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $galleries)
    {
        $gallery = Galleries::find($galleries);
        if ($gallery != null) {
            $gallery->fill($request->all());
            $gallery->save();
            return response()->json(['gallery' => $gallery], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($gallery)
    {
       $gallery = Galleries::find($gallery);
       if ($gallery == null) {
           return response()->json(['message' => 'Not found'], 404);
       }
       $gallery->delete();
       return response()->json(['message' => 'Deleted'], 204);
    }

}
