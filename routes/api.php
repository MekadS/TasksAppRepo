<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/task', 'index')->name('task.index');
    Route::post('/task', 'store')->name('task.store');
    Route::put('/task/{task}', 'update')->name('task.update');
    Route::delete('/task/{task}', 'destroy')->name('task.destroy');
});

// Route::controller(ReligionController::class)->group(function () {
//     Route::get('/religion', 'index')->name('religion.index');
//     Route::post('/religion', 'insert')->name('religion.insert');
//     Route::put('/religion/{religion}', 'edit')->name('religion.edit');
//     Route::delete('/religion/{religion}', 'delete')->name('religion.delete');
// });