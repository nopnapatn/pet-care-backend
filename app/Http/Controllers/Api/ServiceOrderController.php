<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingOrder;
use App\Models\Enums\BookingOrderStatus;
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
            'service_date' => $request->service_date,
            'total_price' => $request->total_price,
            'pet_type' => $request->pet_type,
            'status' => "WAITING",
        ]);

        // Merge packageID and alacarteIDs into a single array
        $serviceItemIDs = array_merge([$request->package_id], explode(',', $request->alacarte_ids));

        // Attach the service items to the service order
        $serviceOrder->serviceItems()->sync($serviceItemIDs);

        return $serviceOrder;
    }

    public function isAvailable(Request $request)
    {

        $serviceOrders = ServiceOrder::where('service_date', $request->service_date)
            ->get();

        if (count($serviceOrders) == 5) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function getUserCurrentOrder(Request $request, $id)
    {
        $serviceOrders = ServiceOrder::where('user_id', $id)->get();

        return $serviceOrders;
    }

    public function getUsersOrder(Request $request, $id)
    {
        $serviceOrders = ServiceOrder::where('user_id', $id)->get();

        $serviceItems = $serviceOrders->load('serviceItems');

        return $serviceOrders;

    }
}
