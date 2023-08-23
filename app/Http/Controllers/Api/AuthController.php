<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        
        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->first();


            $token = null;
            if ($user->role === 'admin') {
                $token = $user->createToken('admin-token', ['getUsers']);
            } else {
                $token = $user->createToken('owner-token',[
                'getApartment', 'createApartment', 'editApartment', 'deleteApartment',
                'getTenant', 'createTenant', 'editTenant', 'deleteTenant'
                ] );
            }

            return response()->json([
                'success' => true,
                'message' =>'Successfully logged in',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'token' =>$token->plainTextToken,
                ],
                
            ]);          
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Username or password does not match'
            ]);
        }
    }
}
