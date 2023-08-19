<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantStoreRequest;
use App\Http\Requests\TenantUpdateRequest;
use App\Http\Resources\TenantResource;
use App\Models\Apartment;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TenantResource::collection(Tenant::paginate());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantStoreRequest $request)
    {
        return TenantResource::make(
            Tenant::create([
                'name' => $request->name,
                'apartment_id' => $request->apartmentId,
                'email' => $request->email,
                'contact' => $request->contact,
                'occupantsQty' => $request->occupantsQty,
                'start_date' => Carbon::parse(strtotime($request->startDate)),
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return TenantResource::make($tenant);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TenantUpdateRequest $request, Tenant $tenant)
    {
        if (isset($request->name)) {
            $tenant->name = $request->name;
        }
        if (isset($request->apartmentId)) {
            $tenant->apartment_id = $request->apartmentId;
        }
        if (isset($request->email)) {
            $tenant->email = $request->email;
        }
        if (isset($request->contact)) {
            $tenant->contact = $request->contact;
        }
        if (isset($request->occupantsQty)) {
            $tenant->occupantsQty = $request->occupantsQty;
        }
        if (isset($request->startDate)) {
            $tenant->start_date = $request->startDate;
        }


        $tenant->save();

        return TenantResource::make($tenant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
