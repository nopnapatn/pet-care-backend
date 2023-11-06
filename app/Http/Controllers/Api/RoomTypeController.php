<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $roomType = new RoomType();
        $roomType->fill($request->all());
        $roomType->save();

        for ($i = 1; $i <= $request->get("available_amount"); $i++) {
            $room = new Room();
            $room->room_type_id = $roomType->id;
            $room->number = $request->get("start") . $i;
            $room->status = 'AVAILABLE';
            $room->save();
        }
        return $roomType;
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        return $roomType;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
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
