<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Validator;
class TestController extends Controller
{
    public function validateForm(Request $request)
    {
       /* $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);
     

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Validation successful, perform other actions
    
        return response()->json(['message' => 'Form validated successfully']);
        
    }*/
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        // Add other validation rules for your form fields
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Validation successful, perform other actions

    return response()->json(['message' => 'Form validated successfully']);
}
}
