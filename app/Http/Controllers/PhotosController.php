<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\Photos;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photos::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $photos = Photos::create($request->all());
        return response()->json(['photos' => $photos], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photos $photos)
    {
        $photos = Photos::find($photos);
        if ($photos!= null) {
            return $photos;
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $photos)
    {
        $photo = Photos::find($photos);
        if ($photo != null) {
            $photo->fill($request->all());
            $photo->save();
            return response()->json(['photo' => $photo], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $photos)
    {
        $photo = Photos::find($photos);
        if ($photo!= null) {
            $photo->delete();
            return response()->json(['message' => 'Deleted'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }


    public function getPhotosByGallery($galleryId)
    {
        $gallery = Galleries::find($galleryId);
        $photos = $gallery->photos;
        if ($photos!= null) {
            return response()->json($photos);
        }
        return response()->json(['message' => 'Not found'], 404);
        
    }
}
