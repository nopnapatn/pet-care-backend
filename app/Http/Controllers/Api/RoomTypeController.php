<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enums\InUseStatus;
use App\Models\Enums\MaintenanceStatus;
use App\Models\ImageCatalogue;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::all();
        // $roomTypes->load('imageCatalogues');

        return $roomTypes;
    }

    public function getDogRooms()
    {
        $roomTypes = RoomType::where('pet_type', 'DOG')->get();
        return $roomTypes;
    }
    public function getCatRooms()
    {
        $roomTypes = RoomType::where('pet_type', 'CAT')->get();
        return $roomTypes;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric|min:0',
        //     'pet_type' => 'required|in:cat,dog', // You can specify allowed values
        //     'available_amount' => 'required|integer|min:0',
        //     'max_pets' => 'required|integer|min:0',
        //     'images' => 'array', // Ensure it's an array of files
        //     'images.*' => 'image|mimes:jpeg,png,gif|max:2048', // Validate each image file
        // ];

        // Validate the request data against the rules
        // $validatedData = $request->validate($rules);

        $roomType = new RoomType();
        $roomType->fill($request->except('images')); // Exclude images from the request data
        $roomType->save();

        for ($i = 1; $i <= $request->get("available_amount"); $i++) {
            $room = new Room();
            $room->room_type_id = $roomType->id;
            $room->number = $request->get("start") . $i;
            $room->status = 'AVAILABLE';
            $room->save();
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('room-type-images', $fileName, 'public');
                array_push($imagePaths, $imagePath);
            }

            foreach ($imagePaths as $imagePath) {
                $imageCatalogue = new ImageCatalogue();
                $imageCatalogue->room_type_id = $roomType->id;
                $imageCatalogue->image_url = $imagePath;
                $imageCatalogue->save();
            }
        }

        return response()->json([
            'message' => 'Room type created successfully',
            'room_type' => $roomType,
        ]);
    }


    public function show(RoomType $roomType)
    {
        return $roomType;
    }

    public function update(Request $request, RoomType $roomType)
    {
        // Validate and process the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'pet_type' => 'required|in:cat,dog', // Adjust to your pet types
            'available_amount' => 'required|integer|min:0',
            'max_pets' => 'required|integer|min:0',
            'start' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust to your file requirements
        ]);

        // Update the room type information
        $roomType->update($request->all());

        // Handle file uploads and delete old images
        if ($request->hasFile('images')) {
            // Delete existing images
            foreach ($roomType->imageCatalogues as $imageCatalogue) {
                Storage::disk('public')->delete($imageCatalogue->image_url);
                $imageCatalogue->delete();
            }

            // Upload new images
            $images = $request->file('images');

            foreach ($images as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('room-type-images', $fileName, 'public');
                $imageCatalogue = new ImageCatalogue();
                $imageCatalogue->room_type_id = $roomType->id;
                $imageCatalogue->image_url = $imagePath;
                $imageCatalogue->save();
            }
        }

        return $roomType;
    }


    public function setStatus(RoomType $roomType, Request $request)
    {
        $roomType->status = $request->get('status');
        $roomType->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $title = $roomType->title;
        $roomType->delete();
        return response()->json(['message' => $title . ' deleted successfully'], 200);
    }
}
