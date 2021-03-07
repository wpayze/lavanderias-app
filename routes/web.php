<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\configurationController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\select2controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource("clientes", clientController::class, [
    'names' => [
        'index' => 'clientes'
    ]
])->middleware(['auth:sanctum', 'verified']);

Route::resource("ordenes", orderController::class)
->names([
    "index" => "ordenes"
])
->parameters([
    "ordenes" => "order"
])
->middleware(['auth:sanctum', 'verified']);

Route::get("/ajax-client-search", [select2controller::class, 'clientSearch']);

Route::get("/configuracion", [configurationController::class, "index"])
->name("configuracion")->middleware(['auth:sanctum', 'verified']);

Route::get("/configuracion/editPieceType/{pieceType}", [configurationController::class, "editPieceType"])
->name("editPieceType")->middleware(['auth:sanctum', 'verified']);

Route::put("/configuracion/updatePieceType/{pieceType}", [configurationController::class, "updatePieceType"])
->name("updatePieceType")->middleware(['auth:sanctum', 'verified']);

Route::post("/serviceType", [configurationController::class, "storeServiceType"])
->name("storeServiceType")->middleware(['auth:sanctum', 'verified']);

Route::post("/pieceType", [configurationController::class, "storePieceType"])
->name("storePieceType")->middleware(['auth:sanctum', 'verified']);


