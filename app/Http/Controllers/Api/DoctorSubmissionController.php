<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeleformSubmission;
use Illuminate\Http\Request;

class DoctorSubmissionController extends Controller
{
    public function myCases()
    {
        return TeleformSubmission::where('doctor_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $submission = TeleformSubmission::where('doctor_id', auth()->id())
            ->findOrFail($id);

        $submission->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Submission ' . $request->status
        ]);
    }
}
