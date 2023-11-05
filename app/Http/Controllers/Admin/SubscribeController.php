<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function index()
    {
        try {
            $subscribes = Subscribe::get();
            return response()->json([
                'success' => true,
                'subscribes' => $subscribes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'subscribes' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {

        try {
            $validation = Validator::make($request->all(), [
                'email' => ['required', 'email'],
            ]);
            if ($validation->fails()) {
                return response()->json(['success' => false, 'message' => $validation->errors()->all()]);
            } else {
                $subscribe = Subscribe::create([
                    'email' => $request->email,
                ]);
                if ($subscribe) {
                    return response()->json(['success' => true, 'message' => 'Subscibe successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Some problem']);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function getTotalSub()
    {
        try {
            $subscribes = Subscribe::count();
            if($subscribes ){
                return response()->json([
                'success' => true,
                'subscribes' => $subscribes
            ]);
        }else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some problem'
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'subscribes' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $result = Subscribe::findOrFail($id)->delete();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Subscribes Delete successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some problem'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}