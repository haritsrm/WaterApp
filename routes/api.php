<?php

use Illuminate\Http\Request;

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
use App\Monitor;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/record-data', function (Request $request) {
    $monitor = new Monitor;
    $monitor->pH = $request->pH;
    $monitor->turbidity = $request->turbidity;
    $monitor->temperature = $request->temperature;
    if ($monitor->save()) {
        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'Berhasil record data..'
        ]);
    }

    return response()->json([
        'status' => false,
        'code' => 500,
        'message' => 'Gagal record data..'
    ]);
});
