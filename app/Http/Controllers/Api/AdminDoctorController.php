<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class AdminDoctorController extends Controller
{
    public function index()
    {
        return Doctor::with('user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'specialization' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor'
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization
        ]);

        return response()->json([
            'message' => 'Doctor created successfully',
            'doctor' => $doctor->load('user')
        ]);
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->user()->delete();

        return response()->json(['message' => 'Doctor deleted']);
    }
}
