<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'firstName' => ['string', 'max:255', 'nullable'],
            'lastName' => ['string', 'max:255', 'nullable'],
            'phone' => ['string', 'nullable'],
        ]);

        if (isset($request->firstName)) {
            $user->first_name = $request->firstName;
        }

        if (isset($request->lastName)) {
            $user->last_name = $request->lastName;
        }

        if (isset($request->phone)) {
            $user->phone_number = $request->phone;
        }

        $user->save();

        $userData = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
        ];

        return response()->json($userData);
    }

    public function changePassword(Request $request, $id)
    {
        // Retrieve the user by ID from the database
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Validate the request data
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        // Check if the current password matches the one in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }

        // Check if the new password and confirm new password match
        if ($request->new_password !== $request->confirm_password) {
            return response()->json(['error' => 'New password and confirm new password must be the same'], 400);
        }

        // Check if the new password is the same as the current password
        if ($request->current_password == $request->new_password) {
            return response()->json(['error' => 'New password cannot be the same as current password'], 400);
        }

        // Update the password with the new one
        $user->password = bcrypt($request->new_password);

        // Save the changes to the user model
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }
}
