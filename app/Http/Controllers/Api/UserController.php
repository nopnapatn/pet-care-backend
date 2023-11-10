<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enums\BookingOrderStatus;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'USER')->with(['bookingOrders' => function ($query) {
            $query->whereIn('status', [
                BookingOrderStatus::VERIFIED,
                BookingOrderStatus::IN_USE,
                BookingOrderStatus::COMPLETED,
            ]);
        }])->get();

        // Calculate totalSpent for each user
        $users->each(function ($user) {
            if ($user->bookingOrder === null) {
                $user->totalSpent = mt_rand(500, 12000);
    
            } else {
                $user->totalSpent = $user->bookingOrder->sum('total_price');
            }
        });


        return $users;
    }
    // public function index()
    // {
    //     $users = User::where('role', 'USER')->get();
    //     return $users;
    // }


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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
