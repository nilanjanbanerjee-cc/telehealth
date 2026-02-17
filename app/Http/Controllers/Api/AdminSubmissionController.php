<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeleformSubmission;
use Illuminate\Http\Request;

class AdminSubmissionController extends Controller
{
    public function index()
    {
        return TeleformSubmission::with('doctor')
            ->latest()
            ->get();
    }

    public function assignDoctor(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id'
        ]);

        $submission = TeleformSubmission::findOrFail($id);

        $submission->update([
            'doctor_id' => $request->doctor_id
        ]);

        return response()->json([
            'message' => 'Doctor assigned successfully'
        ]);
    }
}
