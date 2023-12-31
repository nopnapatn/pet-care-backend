<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingOrder;
use App\Models\Enums\BookingOrderStatus;
use App\Models\Payment;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();

        return $payments;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $bookingOrder = BookingOrder::findOrFail($request->get('booking_order_id'));
        $bookingOrder = BookingOrder::findOrFail($request->get('booking_order_id'));
        $bookingOrder->status = 'PENDING';
        $bookingOrder->save();
        $payment = new Payment();
        $payment->booking_order_id = $request->get('booking_order_id');
        $payment->user_id = $request->get('user_id');
        $payment->name = $request->get('name');
        $payment->time = $request->get('time');
        $payment->date = $request->get('date');
        $payment->type = $request->get('type');
        $payment->amount = $request->get('amount');

        if ($request->hasFile('slip')) {
            $image = $request->file('slip');
            $imageName = $payment->name . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/slips'), $imageName);
            $imagePath = 'images/slips/' . $imageName;
        }
        // } else {
        //     return response()->json(['message' => 'No file uploaded'], 400);
        // }

        $imageURL = asset($imagePath);
        $payment->slip_path = $imageURL;
        $payment->save();
        if ($payment->save()) {
            return response()->json(['message' => 'Payment created successfully', 'payment' => $payment, 'imagePath' => $imagePath], 200);
        } else {
            return response()->json(['message' => 'Payment created failed'], 400);
        }
    }

    public function serviceStore(Request $request)
    {
        // $bookingOrder = BookingOrder::findOrFail($request->get('booking_order_id'));
        $serviceOrder = ServiceOrder::findOrFail($request->get('service_order_id'));
        $serviceOrder->status = 'PENDING';
        $serviceOrder->save();
        $payment = new Payment();
        $payment->service_order_id = $request->get('service_order_id');
        $payment->user_id = $request->get('user_id');
        $payment->name = $request->get('name');
        $payment->time = $request->get('time');
        $payment->date = $request->get('date');
        $payment->type = $request->get('type');
        $payment->amount = $request->get('amount');

        if ($request->hasFile('slip')) {
            $image = $request->file('slip');
            $imageName = $payment->name . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/slips'), $imageName);
            $imagePath = 'images/slips/' . $imageName;
        }
        // } else {
        //     return response()->json(['message' => 'No file uploaded'], 400);
        // }

        $imageURL = asset($imagePath);
        $payment->slip_path = $imageURL;
        $payment->save();
        if ($payment->save()) {
            return response()->json(['message' => 'Payment created successfully', 'payment' => $payment, 'imagePath' => $imagePath], 200);
        } else {
            return response()->json(['message' => 'Payment created failed'], 400);
        }
    }

    public function verifyPayment($id)
    {
        $payment = Payment::find($id);
        $bookingOrder = BookingOrder::find($payment->booking_order_id);
        if (!$bookingOrder) {
            return response()->json([
                'message' => 'Booking order not found',
            ], 404);
        }
        $bookingOrder->status = BookingOrderStatus::VERIFIED;
        $bookingOrder->save();

        return response()->json([
            'message' => 'Payment verified',
            'booking_order' => $bookingOrder,
        ], 201);
    }

    public function rejectPayment($id)
    {
        $payment = Payment::find($id);
        $bookingOrder = BookingOrder::find($payment->booking_order_id);
        if (!$bookingOrder) {
            return response()->json([
                'message' => 'Booking order not found',
            ], 404);
        }
        $bookingOrder->status = BookingOrderStatus::CANCELED;
        $bookingOrder->save();

        return response()->json([
            'message' => 'Payment rejected',
            'booking_order' => $bookingOrder,
        ], 201);
    }

    public function getHotelPayments()
    {
        $payments = Payment::where('type', 'HOTEL')->get();
        return response()->json(['payments' => $payments], 200);
    }

    public function getServicePayments()
    {
        $payments = Payment::where('type', 'SERVICE')->get();
        return response()->json(['payments' => $payments], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        $slip_url = asset($payment->slip_path);
        return $payment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }
}
