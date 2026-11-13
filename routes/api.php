<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check-freeze', function (Request $request) {
    $pcName = $request->query('pc_name');
    return response()->json(['frozen' => Cache::get("freeze_$pcName", false)]); // The default value returned if the key does not exist in the cache.
});

Route::post('/toggle-freeze', function (Request $request) {
    $pcName = $request->input('pc_name');
    $status = $request->input('status'); // true = freeze, false = unfreeze
    Cache::put("freeze_$pcName", $status);
    return response()->json(["message" => "Freeze status updated", 'cache' => Cache::get("freeze_$pcName") . " freeze_$pcName"]);
});
