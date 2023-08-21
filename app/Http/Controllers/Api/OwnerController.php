<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerStoreRequest;
use App\Http\Requests\OwnerUpdateRequest;
use App\Http\Resources\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OwnerResource::collection(Owner::get());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OwnerStoreRequest $request)
    {
       return OwnerResource::make(
            Owner::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'contact' => $request->contact,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        return OwnerResource::make($owner);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OwnerUpdateRequest $request, Owner $owner)
    {

        if (isset($request->name)) {
            $owner->name = $request->name;
        }
        if (isset($request->address)) {
            $owner->address = $request->address;
        }
        if (isset($request->email)) {
            $owner->email = $request->email;
        }
        if (isset($request->contact)) {
            $owner->contact = $request->contact;
        }
        if (isset($request->username)) {
            $owner->username = $request->username;
        }
        if (isset($request->password)) {
            $owner->password = $request->password;
        }
        
        $owner->save();

        return OwnerResource::make($owner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
