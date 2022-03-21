<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Save contactc on DB and notify via email
     */
    public function store(Request $request) {
        // VALIDAZIONE
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'errors' => $validator->errors() ]);
        }

        $data = $request->all();

        // Save on db

        // Send email

        return response()->json($data);
    }
}
