<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enums\InUseStatus;
use App\Models\Enums\MaintenanceStatus;
use App\Models\Enums\RoomStatus;
use App\Models\ImageCatalogue;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::all();

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
    public function getAvailableRoomTypes(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $petsAmount = $request->input('pets_amount');

        // $roomTypes = RoomType::where('max_pets', '>=', $petsAmount)->get();
        $roomTypes = RoomType::where(function ($query) use ($petsAmount) {
            $query->whereRaw('CAST(max_pets AS UNSIGNED) >= ?', [$petsAmount]);
        })->get();

        $availableRoomTypes = [];
        foreach ($roomTypes as $roomType) {
            if (app(BookingController::class)->checkRoomAvailability($roomType, $startDate, $endDate)) {
                $availableRoomTypes[] = $roomType;
            }
        }
        return $availableRoomTypes;
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
            $room->status = RoomStatus::AVAILABLE;
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
                Log::info($imagePath);
                $imageCatalogue = new ImageCatalogue();
                $imageCatalogue->room_type_id = $roomType->id;
                $imageCatalogue->image_url = $imagePath;
                $imageCatalogue->save();
            }
        }

        return $roomType;
    }


    public function show(RoomType $roomType)
    {
        return $roomType;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $roomType->fill($request->all());
        $roomType->save();

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
