<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\configurationController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\reportController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [dashboardController::class, "dashboard"])
->name('dashboard');

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

Route::get("/createAccounts", [configurationController::class, "createAccounts"]);
Route::post("/saveAccount", [configurationController::class, "saveAccount"])
->name("saveAccount");

Route::get("/ajax-client-search", [select2controller::class, 'clientSearch']);
Route::get("/revenueByMonth", [reportController::class, 'revenueByMonth']);

Route::get("/configuracion", [configurationController::class, "index"])
->name("configuracion")->middleware(['auth:sanctum', 'verified']);

Route::get("/configuracion/editPieceType/{pieceType}", [configurationController::class, "editPieceType"])
->name("editPieceType")->middleware(['auth:sanctum', 'verified']);

Route::put("/configuracion/updatePieceType/{pieceType}", [configurationController::class, "updatePieceType"])
->name("updatePieceType")->middleware(['auth:sanctum', 'verified']);

Route::delete("/configuracion/deletePieceType/{pieceType}", [configurationController::class, "deletePieceType"])
->name("deletePieceType")->middleware(['auth:sanctum', 'verified']);

Route::post("/serviceType", [configurationController::class, "storeServiceType"])
->name("storeServiceType")->middleware(['auth:sanctum', 'verified']);

Route::post("/pieceType", [configurationController::class, "storePieceType"])
->name("storePieceType")->middleware(['auth:sanctum', 'verified']);

Route::get("/configuracion/editServiceType/{serviceType}", [configurationController::class, "editServiceType"])
->name("editServiceType")->middleware(['auth:sanctum', 'verified']);

Route::put("/configuracion/updateServiceType/{serviceType}", [configurationController::class, "updateServiceType"])
->name("updateServiceType")->middleware(['auth:sanctum', 'verified']);

