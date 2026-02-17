<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeleformStep;
use App\Models\TeleformSubmission;
use App\Models\TeleformQuestion;

class PatientTeleformController extends Controller
{
    

    public function index()
    {
        return TeleformStep::with('questions')
            ->orderBy('step_order')
            ->get();
    }
    public function submit(Request $request)
    {
        $questions = TeleformQuestion::pluck('field_key')->toArray();

        $rules = [
            'email' => 'required|email',
        ];

        // Dynamically validate teleform fields
        foreach ($questions as $field) {
            $rules[$field] = 'nullable';
        }

        $validated = $request->validate($rules);

        $submission = TeleformSubmission::create([
            'email' => $validated['email'],
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'answers' => collect($validated)->except(['email'])->toArray(),
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Submission received successfully',
            'submission_id' => $submission->id
        ]);
    }
}
