<?php

use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    $data = Matiere::all();
    return json_encode([
        'success'=>true,
        'error'=>false,
        'data'=> $data,
    ]);
});
