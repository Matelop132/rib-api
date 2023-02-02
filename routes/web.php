<?php

use App\Http\Controllers\IbanController;
use App\Http\Controllers\RibController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
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

Route::get('/', [RibController::class, "welcome"]);


Route::post('/api/operations', [UserAuth::class, "api_operations_login"]);
Route::get('/api/application', [UserAuth::class, "api_operations"]);
Route::post('/api', [UserAuth::class, "verification"]);
Route::get('/login', [UserAuth::class, "login"]);

Route::post('/api/IBan', [IbanController::class, "iban_verifified"]);

Route::get('/api/operations/releve', [IbanController::class, "iban"]);
Route::get('/api/operations/paiements', [RibController::class, "paiements"]);
Route::get('/api/operations/recettes', [RibController::class, "recettes"]);
Route::get('/api/operations/depenses', [RibController::class, "depenses"]);
Route::get('/api/operations/ajout', [RibController::class, "ajout"]);


Route::post('/api/operations_rib', [RibController::class, "operations_rib"]);
Route::get('/api/operations/ajout_paiment', [RibController::class, "ajout_paiment"]);
Route::post('/api/operations/verification_paiement', [RibController::class, "verification_paiement"]);


Route::get('/disconnect', [RibController::class, "disconnect"]);

