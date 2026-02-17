<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Patient submission endpoint working'
        ]);
    }
}
