<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingOrder;
use App\Models\Enums\BookingOrderStatus;
use App\Models\Enums\RoomStatus;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $bookingKey = "allBookingOrders";
    //     $value = Redis::get($bookingKey);
    //     if (empty($value)) {
    //         // BookingOrders with user name by joining the users table with booking_orders table
    //         $bookingOrders = $bookingOrders = BookingOrder::select('booking_orders.*', 'users.first_name as user_name')
    //             ->join('users', 'booking_orders.user_id', '=', 'users.id')
    //             ->get();
    //         Redis::set($bookingKey, json_encode($bookingOrders));
    //     } else {
    //         $bookingOrders = json_decode($value);
    //     }
    //     return $bookingOrders;
    // }

    public function index()
    {
        $bookingOrders = BookingOrder::all();
        return $bookingOrders;
    }

    public function updateBookingOrdersCache()
    {
        $bookingKey = "allBookingOrders";
        $bookingOrders = BookingOrder::select('booking_orders.*', 'users.first_name as user_name')
            ->join('users', 'booking_orders.user_id', '=', 'users.id')
            ->get();
        Redis::set($bookingKey, json_encode($bookingOrders));
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
        $this->validateBookingOrder($request);

        $data = $request->all();

        // Find the room type
        $roomType = RoomType::find($data['room_type_id']);
        $checkIn = $data['check_in'];
        $checkOut = $data['check_out'];
        $user = User::find($data['user_id']);

        // Check if there are rooms available
        if (!$this->checkRoomAvailability($roomType, $checkIn, $checkOut)) {
            return response()->json([
                'message' => 'No rooms available for the selected dates',
            ], 400);
        }

        $bookingOrder = $this->createBooking($data, $user);

        if ($bookingOrder) {
            $this->updateBookingOrdersCache();
            return response()->json([
                'message' => 'Booking order created successfully',
                'booking_order' => $bookingOrder,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Booking order creation failed',
            ], 400);
        }
    }

    public function createBooking(array $data, User $user)
    {
        // Find the room type
        $roomType = RoomType::find($data['room_type_id']);

        $checkIn = new \DateTime($data['check_in']);
        $checkOut = new \DateTime($data['check_out']);
        // Calculate the number of nights
        $nights = $checkIn->diff($checkOut)->format('%a');
        $days = $nights + 1;

        // $room = $this->book($roomType->id, $user->id);
        // if ($room instanceof Room) {
        // Create the booking order

        $bookingOrder = new BookingOrder();
        $bookingOrder->room_type_id = $roomType->id;
        $bookingOrder->user_id = $user->id;
        $bookingOrder->check_in = $checkIn;
        $bookingOrder->check_out = $checkOut;
        $bookingOrder->pets_amount = $data['pets_amount'];
        $bookingOrder->total_price = $this->calculateTotalPrice($roomType->price, $days);
        if (isset($data['owner_instruction'])) {
            $bookingOrder->owner_instruction = $data['owner_instruction'];
        }
        $bookingOrder->save();

        // $room->booking_order_id = $bookingOrder->id;
        // $room->save();

        return $bookingOrder;
        // }
        // return null;
    }

    // public function book($roomTypeId, $userId)
    // {
    //     $roomType = RoomType::find($roomTypeId);
    //     // Find the first available room
    //     $room = $roomType->rooms()->where('status', RoomStatus::AVAILABLE)->first();
    //     if (!$room) {
    //         return response()->json([
    //             'message' => 'No rooms available',
    //         ], 400);
    //     }

    //     // Update the room type details
    //     $roomType->available_amount = $roomType->getAvailableRoomsCount();
    //     $roomType->save();
    //     return $room;
    // }

    public function checkRoomAvailability($roomType, $checkIn, $checkOut,)
    {
        if (!$roomType) {
            return response()->json([
                'message' => 'Room type not found',
            ], 400);
        }

        $maxRoomCount = Room::where('room_type_id', $roomType->id)->count();

        $checkIn = new \DateTime($checkIn);
        $checkOut = new \DateTime($checkOut);

        // Query for conflicting booking
        $conflictingBookings = BookingOrder::where('room_type_id', $roomType->id)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->get();

        $roomType->available_amount = $maxRoomCount - $conflictingBookings->count();
        $roomType->save();
        if ($conflictingBookings->count() >= $maxRoomCount) {
            return false;
        }
        return true;
    }

    public function calculateTotalPrice($price, $days)
    {
        return $price * $days;
    }

    public function getBookingOrders()
    {
        $user = auth()->user();
        $bookingOrders = BookingOrder::where('user_id', $user->id)->get();
        return $bookingOrders;
    }

    public function checkIn($id)
    {
        $bookingOrder = BookingOrder::find($id);
        if (!$bookingOrder) {
            return response()->json([
                'message' => 'Booking order not found',
            ], 400);
        }
        $room = $bookingOrder->roomType->rooms()->where('status', RoomStatus::AVAILABLE)->first();
        $room->booking_order_id = $bookingOrder->id;
        $room->user_id = $bookingOrder->user_id;
        $room->status = RoomStatus::IN_USE;
        $room->save();

        $bookingOrder->room_number = $room->number;
        $bookingOrder->status = BookingOrderStatus::IN_USE;
        $bookingOrder->save();

        $room = Room::where('number', $bookingOrder->room_number)->first();
        $room->status = RoomStatus::IN_USE;
        $room->user_id = $bookingOrder->user_id;
        $room->save();

        $roomType = $room->roomType;
        $roomType->available_amount = $roomType->getAvailableRoomsCount();
        $roomType->save();

        return response()->json([
            'message' => 'Check in successful',
            'booking_order' => $bookingOrder,
        ], 201);
    }

    public function checkOut($id)
    {
        $bookingOrder = BookingOrder::find($id);
        if (!$bookingOrder) {
            return response()->json([
                'message' => 'Booking order not found',
            ], 404);
        }
        $bookingOrder->status = BookingOrderStatus::COMPLETED;
        $bookingOrder->save();

        $room = Room::where('number', $bookingOrder->room_number)->first();
        $room->status = RoomStatus::AVAILABLE;
        $room->user_id = null;
        $room->save();

        $roomType = $room->roomType;
        $roomType->available_amount = $roomType->getAvailableRoomsCount();
        $roomType->save();

        return response()->json([
            'message' => 'Check out successful',
            'booking_order' => $bookingOrder,
        ], 201);
    }

    public function validateBookingOrder(Request $request)
    {
        $rules = [
            'room_type_id' => 'required|exists:room_types,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'pets_amount' => 'required|integer|min:1',
            'owner_instruction' => 'nullable|string',
        ];

        $messages = [
            'room_type_id.required' => 'Room type is required',
            'room_type_id.exists' => 'Room type not found',
            'check_in.required' => 'Check in date is required',
            'check_in.date' => 'Check in date must be a valid date',
            'check_out.required' => 'Check out date is required',
            'check_out.date' => 'Check out date must be a valid date',
            'check_out.after' => 'Check out date must be after check in date',
            'pets_amount.required' => 'Pets amount is required',
            'pets_amount.integer' => 'Pets amount must be an integer',
            'pets_amount.min' => 'Pets amount must be at least 1',
            'owner_instruction.string' => 'Owner instruction must be a string',
        ];

        return $request->validate($rules, $messages);
    }

    public function myBookings($id)
    {
        $user = User::find($id);
        $bookingOrders = BookingOrder::with('roomType')->where('user_id', $user->id)->get();

        return $bookingOrders;
    }

    public function getBookingOrder($id)
    {
        $bookingOrder = BookingOrder::find($id);
        return response()->json([
            'booking_order' => $bookingOrder,
        ], 200);
    }

    public function getWaitingBookingOrders()
    {
        $bookingOrders = BookingOrder::where('status', BookingOrderStatus::WAITING)->get();
        return $bookingOrders;
    }

    public function getPendingBookingOrders()
    {
        $bookingOrders = BookingOrder::with('payment')->where('status', BookingOrderStatus::PENDING)->get();

        return $bookingOrders;
    }
    public function getVerifiedBookingOrders()
    {
        $bookingOrders = BookingOrder::where('status', BookingOrderStatus::VERIFIED)->get();
        return $bookingOrders;
    }
    public function getInUseBookingOrders()
    {
        $bookingOrders = BookingOrder::where('status', BookingOrderStatus::IN_USE)->get();
        return $bookingOrders;
    }
    public function getCompleteBookingOrders()
    {
        $bookingOrders = BookingOrder::where('status', BookingOrderStatus::COMPLETED)->get();
        return $bookingOrders;
    }
    public function getCanceledBookingOrders()
    {
        $bookingOrders = BookingOrder::where('status', BookingOrderStatus::CANCELED)->get();
        return $bookingOrders;
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
