<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Save contactc on DB and notify via email
     */
    public function store(Request $request) {
        $data = $request->all();

        return response()->json($data);
    }
}
