<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\functions;
/*w
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1/'], function () {
    
    Route::get('/getActive',[functions::class, 'getAllActive']);
    Route::post('/updateposition', [functions::class,'updateposition']);
    Route::post('/ifregisted', [functions::class,'ifregisted']);
    Route::get('/getAllAlerts', [functions::class,'getAllAlerts']);
    Route::post('/getallcompany', [functions::class,'getallcompany']);
    
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
