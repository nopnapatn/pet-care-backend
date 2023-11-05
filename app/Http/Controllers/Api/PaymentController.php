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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $bookingOrder = BookingOrder::findOrFail($id);
        $payment = new Payment();
        $payment->booking_order_id = $bookingOrder->id;
        $payment->user_id = $request->get('user_id');
        $payment->name = $request->get('name');
        $payment->time = $request->get('time');
        $payment->date = $request->get('date');
        $payment->amount = $request->get('amount');
        $payment->save();

        return response()->json([
            'message' => 'Payment created successfully',
            'payment' => $payment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
