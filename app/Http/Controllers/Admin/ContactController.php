<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{

    public function index()
    {
        try {
            $contacts = Contact::orderBy('id', 'desc')->get();
            return response()->json([
                'success' => true,
                'contects' => $contacts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'contects' => $e->getMessage(),
            ]);
        }
    }
    
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required']
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $result = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact Sucessfully Admin will responsne you via email'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        }
    }



    
    public function getTotalContects()
    {
        try {
            $contacts = Contact::count();
            return response()->json([
                'success' => true,
                'contects' => $contacts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'contects' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        $result = Contact::findOrFail($id)->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Contact Delete Successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Some Problem'
            ]);
        }
    }
}
