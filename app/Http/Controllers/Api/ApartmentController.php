<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Apartment::query();

        if (isset($request['isOccupied'])) {
            $query->where('is_occupied', $request->isOccupied);
        }

        if ($request->ownerId) {
            $query->where('owner_id', $request->ownerId);
        }


        return ApartmentResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
    {
        return ApartmentResource::make(
            Apartment::create([
                'unit' => $request->unit,
                'address' => $request->address,
                'description' => $request->description,
                'price' => $request->price,
                'owner_id' => $request->ownerId,
                'is_occupied' => $request->isOccupied,
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return ApartmentResource::make($apartment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
        if (isset($request->unit)) {
            $apartment->unit = $request->unit;
        }
        if (isset($request->address)) {
            $apartment->address = $request->address;
        }
        if (isset($request->description)) {
            $apartment->description = $request->description;
        }
        if (isset($request->ownerId)) {
            $apartment->owner_id = $request->ownerId;
        }
        if (isset($request->isOccupied)) {
            $apartment->is_occupied = $request->isOccupied;
        }
       
        $apartment->save();

        return ApartmentResource::make($apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
