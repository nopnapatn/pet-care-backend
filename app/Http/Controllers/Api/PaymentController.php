<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingOrder;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $bookingOrder = BookingOrder::findOrFail($request->get('booking_order_id'));
        $bookingOrder = BookingOrder::findOrFail($request->get('booking_order_id'));
        $payment = new Payment();
        $payment->booking_order_id = $request->get('booking_order_id');
        $payment->user_id = $request->get('user_id');
        $payment->name = $request->get('name');
        $payment->time = $request->get('time');
        $payment->date = $request->get('date');
        $payment->amount = $request->get('amount');

        if ($request->hasFile('slip')) {
            $image = $request->file('slip');
            $imageName = $payment->name . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/slips'), $imageName);
            $imageURL = 'images/slips/' . $imageName;
            $payment->slip_path = $imageURL;
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        $payment->save();
        $imagePath = asset($payment->slip_path);
        if ($payment->save()) {
            return response()->json(['message' => 'Payment created successfully', 'payment' => $payment, 'imagePath' => $imagePath], 200);
        } else {
            return response()->json(['message' => 'Payment created failed'], 400);
        }
    }
   
    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }
}
