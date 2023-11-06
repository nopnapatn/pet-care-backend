<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enums\ServiceType;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\ServiceOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }


    public function createAlacarteService(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Assuming images will be an array
            'images.*' => 'image|mimes:jpeg,png,gif|max:2048', // Validation for each image in the array
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422); // Return a 422 Unprocessable Entity response with validation errors
        }

        // Create a new service
        $service = new Service();
        $service->title = $request->title;
        $service->type = ServiceType::ALACARTE;
        $service->description = $request->description;
        $service->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $imageName = $service->title . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/services'), $imageName);
                $imageURL = 'images/services/' . $imageName;
                array_push($imagePaths, $imageURL);
            }

            foreach ($imagePaths as $imagePath) {
                $serviceImage = new ServiceImage();
                $serviceImage->service_id = $service->id;
                $serviceImage->image_path = $imagePath;
                $serviceImage->save();
            }
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        return response()->json([
            'message' => 'Service created successfully',
            'service' => $service,
        ]);
    }

    public function createAlacarteServiceOption(Request $request, Service $service)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'up_price_status' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422); // Return a 422 Unprocessable Entity response with validation errors
        }

        // Create a new service option
        $serviceOption = new ServiceOption();
        $serviceOption->service_id = $service->id;
        $serviceOption->title = $request->title;
        $serviceOption->price = $request->price;
        $serviceOption->up_price_status = $request->up_price_status;
        $serviceOption->save();

        return response()->json([
            'message' => 'Service option created successfully',
            'service_option' => $serviceOption,
        ]);
    }

    public function updateAlacarteService(Request $request, $id)
    {
        $rules = [
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Assuming images will be an array
            'images.*' => 'image|mimes:jpeg,png,gif|max:2048', // Validation for each image in the array
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422); // Return a 422 Unprocessable Entity response with validation errors
        }

        // Find the service to update
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        // Update the service details
        if ($request->has('title')) {
            $service->title = $request->title;
        }

        if ($request->has('description')) {
            $service->description = $request->description;
        }

        $service->save();

        // Image upload logic for updates
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $imageName = $service->title . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/services'), $imageName);
                $imageURL = 'images/services/' . $imageName;
                array_push($imagePaths, $imageURL);
            }

            // Save the updated image paths to the database
            foreach ($imagePaths as $imagePath) {
                $serviceImage = new ServiceImage();
                $serviceImage->service_id = $service->id;
                $serviceImage->image_path = $imagePath;
                $serviceImage->save();
            }
        }

        return response()->json([
            'message' => 'Service updated successfully',
            'service' => $service,
        ]);
    }

    public function updateAlacarteServiceOption(Request $request, Service $service, $optionId)
    {
        $rules = [
            'title' => 'string|max:255',
            'price' => 'numeric',
            'up_price_status' => 'boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422); // Return a 422 Unprocessable Entity response with validation errors
        }

        // Find the service option to update
        $serviceOption = ServiceOption::where('service_id', $service->id)
            ->where('id', $optionId)
            ->first();

        if (!$serviceOption) {
            return response()->json(['message' => 'Service option not found'], 404);
        }

        // Update the service option details
        if ($request->has('title')) {
            $serviceOption->title = $request->title;
        }

        if ($request->has('price')) {
            $serviceOption->price = $request->price;
        }

        if ($request->has('up_price_status')) {
            $serviceOption->up_price_status = $request->up_price_status;
        }

        $serviceOption->save();

        return response()->json([
            'message' => 'Service option updated successfully',
            'service_option' => $serviceOption,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
