<?php

use App\Http\Controllers\API\DiagnosisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('diagnosis')->group(function () {
    Route::get('/', [DiagnosisController::class, 'index']);
    Route::post('',  [DiagnosisController::class, 'store']);
    Route::get('{id}', [DiagnosisController::class, 'show'])->where('id', '[0-9]+');
    Route::patch('{id}',  [DiagnosisController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('{id}',  [DiagnosisController::class, 'destroy'])->where('id', '[0-9]+');
    Route::post('/upload/csv', [DiagnosisController::class, 'uploadCSV']);
});


Route::fallback(function () {
    return response()->json(['message' => 'This route does not exist'], 404);
});
