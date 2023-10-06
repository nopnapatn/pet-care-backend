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
        $bookingOrders = BookingOrder::all();
        return $bookingOrders;
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
        // Validate date

        // Find the room type
        $roomType = RoomType::find($request->get('room_type_id'));
        // Check if there are rooms available
        if (!$roomType->hasAvailableRooms()) {
            return redirect()->back()->withErrors(['message' => 'No rooms available'], 400);
        }

        // Decrease the available amount
        $roomType->available_amount -= 1;
        $roomType->save();

        // Find the first available room
        $room = $roomType->rooms()->where('status', 'AVAILABLE')->first();
        // Update the room details
        $room->status = 'UNAVAILABLE';
        $room->user_id = auth()->user()->id;
        $room->save();

        // Create the booking order
        $bookingOrder = new BookingOrder();
        $bookingOrder->room_number = $room->number;
        $bookingOrder->user_id = auth()->user()->id;
        $bookingOrder->check_in = $request->get('check_in');
        $bookingOrder->check_out = $request->get('check_out');
        $bookingOrder->pets_amount = request()->get('pets_amount');
        $bookingOrder->total_price = $roomType->price * $bookingOrder->pets_amount * $bookingOrder->getTotalDays();
        $bookingOrder->owner_instruction = $request->get('owner_instruction');
        $bookingOrder->save();


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
