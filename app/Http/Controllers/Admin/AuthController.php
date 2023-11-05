<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){

        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $users = User::where('name', $request->name)->first();
            if (!$users) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid username and password',
                ]);
            } else {
                if (!Hash::check($request->password, $users->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid username and password2',
                    ]);
                } else {
                    $token = $users->createToken('token')->plainTextToken;

                    return response()->json([
                        'success' => true,
                        'message' => 'Login Successfully',
                        'token' => $token
                    ]);
                }
            }
        }
    }

    public function admins(Request $request)
    {
        $users = $request->user();
        return response()->json([$users]);
    }

    public function logout(Request $request)
    {
        $id = $request->user()->id;
        auth()->user()->tokens()->where('tokenable_id', $id)->delete();
    }
}
