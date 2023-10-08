<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
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
    public function show(string $email)
    {
        // Retrieve the user by ID from the database
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // You can customize the data you want to send to the frontend
        $userData = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
            'image_url' => $user->image_url,
            // Add other fields you want to include
        ];

        return response()->json($userData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $email)
    {
        // Retrieve the user by email from the database
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Validate the request data
        $request->validate([
            'phone_number' => ['string', 'nullable'],
            'address' => ['string', 'nullable'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048', 'nullable'],
        ]);
    
        // Update the user's phone number and address
        if ($request->has('phone_number')) {
            $user->phone_number = $request->input('phone_number');
        }
    
        if ($request->has('address')) {
            $user->address = $request->input('address');
        }
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image (if exists)
            if ($user->image_url) {
                Storage::disk('public')->delete($user->image_url);
            }
    
            // Upload the new image
            $image = $request->file('image');
            $imagePath = $image->store('user-images', 'public'); // Store the image in the public disk
    
            $user->image_url = $imagePath;
        }
    
        // Save the user's changes
        $user->save();
    
        $userData = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
            'image_url' => $user->image_url,
            // Add other fields you want to include
        ];
    
        return response()->json($userData);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
