<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeleformQuestion;
use App\Models\TeleformStep;

class AdminTeleformQuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'step_id' => 'required|exists:teleform_steps,id',
            'question' => 'required|string',
            'type' => 'required|string',
            'field_key' => 'required|string|unique:teleform_questions,field_key'
        ]);

        return TeleformQuestion::create($request->all());
    }

    public function destroy($id)
    {
        $question = TeleformQuestion::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Question deleted']);
    }
}
