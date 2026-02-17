<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeleformStep;
use Illuminate\Http\Request;

class AdminTeleformStepController extends Controller
{
    public function index()
    {
        return TeleformStep::with('questions')
            ->orderBy('step_order')
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'step_order' => 'required|integer',
            'is_final' => 'boolean'
        ]);

        if ($request->is_final) {
            TeleformStep::where('is_final', true)
                ->update(['is_final' => false]);
        }

        return TeleformStep::create($request->all());
    }

    public function show($id)
    {
        return TeleformStep::with('questions')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $step = TeleformStep::findOrFail($id);

        if ($request->is_final) {
            TeleformStep::where('is_final', true)
                ->update(['is_final' => false]);
        }

        $step->update($request->all());

        return $step;
    }

    public function destroy($id)
    {
        $step = TeleformStep::findOrFail($id);
        $step->delete();

        return response()->json(['message' => 'Step deleted']);
    }
}
