<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Apartment::query();


        if ($request->userId) {
            $query->where('user_id', $request->userId);
        }


        return ApartmentResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
    {
        $user = Auth::user();
        $apartment = Apartment::create([
            'unit' => $request->unit,
            'address' => $request->address,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $user->id,
            
        ]);
        return ApartmentResource::make($apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $id)
    {
        $apartment = Apartment::find($id);
        return ApartmentResource::make($apartment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, $id)
    {
        $apartment = Apartment::find($id);
        if (isset($request->unit)) {
            $apartment->unit = $request->unit;
        }
        if (isset($request->address)) {
            $apartment->address = $request->address;
        }
        if (isset($request->description)) {
            $apartment->description = $request->description;
        }
        if (isset($request->price)) {
            $apartment->price = $request->price;
        }
       
        $apartment->save();

        return ApartmentResource::make($apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
