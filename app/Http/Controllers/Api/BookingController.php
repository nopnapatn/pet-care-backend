<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingOrder;
use App\Models\RoomType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate the request

        $roomType = RoomType::find($request->get('room_type_id'));
        if ($roomType->available_amount < 1) {
            return redirect()->back()->withErrors(['message' => 'No rooms available']);
        }

        $roomType->available_amount -= 1;
        $roomType->save();

        $room = $roomType->rooms()->where('status', 'AVAILABLE')->first();
        $room->status = 'UNAVAILABLE';
        $room->user_id = auth()->user()->id;
        $room->pet_id = $request->get('pet_id');
        $room->save();

        $bookingOrder = new BookingOrder();
        $bookingOrder->room_number = $room->number;
        $bookingOrder->user_id = auth()->user()->id;
        // $bookingOrder->pet_id = $request->get('pet_id');
        $bookingOrder->check_in = $request->get('check_in');
        $bookingOrder->check_out = $request->get('check_out');
        $bookingOrder->pets_amount = request()->get('pets_amount');
        $bookingOrder->total_price = $roomType->price * $bookingOrder->pets_amount * $bookingOrder->getTotalDays();
        $bookingOrder->owner_instruction = $request->get('owner_instruction');
        $petIds = $request->get('pet_ids');
        $pets = [];
        foreach ($petIds as $petId) {
            $pets[] = $petId;
        }
        $bookingOrder->save();
        $bookingOrder->pets()->attach($pets);

        return response()->json([
            'message' => 'Booking successful',
            'booking_order' => $bookingOrder,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingOrder $bookingOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingOrder $bookingOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingOrder $bookingOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingOrder $bookingOrder)
    {
        //
    }
}
