<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{

    public function index()
    {
        $serviceOrders = ServiceOrder::all();

        return response()->json($serviceOrders);
    }

    public function initServiceOrder(Request $request)
    {
        $serviceOrder = ServiceOrder::create([
            'user_id' => $request->user_id,
            'service_item_id' => $request->service_item_id,
            'service_date' => $request->service_date,
            'total_price' => $request->total_price,
            'pet_type' => $request->pet_type,
            'status' => "WAITING"
        ]);

        return response()->json($serviceOrder);
    }
}
