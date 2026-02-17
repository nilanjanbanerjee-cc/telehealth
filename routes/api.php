<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminDoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AdminTeleformStepController;
use App\Http\Controllers\Api\AdminTeleformQuestionController;
use App\Http\Controllers\Api\PatientTeleformController;
use App\Http\Controllers\Api\AdminSubmissionController;
use App\Http\Controllers\Api\DoctorSubmissionController;
// Public login
Route::post('/login', [AuthController::class, 'login']);

// Public patient submit
//Route::post('/patient/submit', [PatientController::class, 'store']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', function () {
        return auth()->user();
    });

});

// Admin only
Route::middleware(['auth:sanctum'])->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('doctors', AdminDoctorController::class);
    });

});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::apiResource('teleform-steps', AdminTeleformStepController::class);

    Route::post('teleform-questions', [AdminTeleformQuestionController::class, 'store']);
    Route::delete('teleform-questions/{id}', [AdminTeleformQuestionController::class, 'destroy']);
});
Route::post('/patient/submit', [PatientController::class, 'store']);
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::apiResource('teleform-steps', AdminTeleformStepController::class);

    Route::post('teleform-questions', [AdminTeleformQuestionController::class, 'store']);
    Route::delete('teleform-questions/{id}', [AdminTeleformQuestionController::class, 'destroy']);
});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::apiResource('teleform-steps', AdminTeleformStepController::class);

    Route::post('teleform-questions', [AdminTeleformQuestionController::class, 'store']);
});
Route::middleware('auth:sanctum')->get('/test-auth', function () {
    return auth()->user();
});
Route::get('teleform', [PatientTeleformController::class, 'index']);
Route::post('patient/submit', [PatientTeleformController::class, 'submit']);
Route::get('submissions', [AdminSubmissionController::class, 'index']);
Route::post('submissions/{id}/assign', [AdminSubmissionController::class, 'assignDoctor']);
Route::middleware(['auth:sanctum', 'role:doctor'])->group(function () {

Route::get('doctor/cases', [DoctorSubmissionController::class, 'myCases']);
Route::post('doctor/cases/{id}/status', [DoctorSubmissionController::class, 'updateStatus']);

});


?>