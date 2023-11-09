<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show($id)
    {
        // Retrieve the user by ID from the database
        $user = User::where('id', $id)->first();

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

    public function update(Request $request, $id)
    {
        // Retrieve the user by email from the database
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Validate the request data
        $request->validate([
            'email' => ['string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'phone' => ['string', 'nullable'],
        ]);

        $user->email = $request->email;
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->phone_number = $request->phone;

        $user->save();

        $userData = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
        ];

        return response()->json($userData);
    }
}
