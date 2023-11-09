<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceItem;
use Illuminate\Http\Request;

class ServiceItemController extends Controller
{

    public function getServiceItemBySize(Request $request) {
        $serviceItems = ServiceItem::where(function($query) use ($request) {
            $query->where('breed_size', $request->breed_size)
                  ->orWhere('type', 'alacarte');
        })->get();

        return response()->json($serviceItems);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceItem $serviceItem)
    {
        //
    }
}
