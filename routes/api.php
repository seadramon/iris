<?php

use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\FPerbaikanController;
use App\Http\Controllers\Api\FPerawatanController;
use App\Http\Controllers\Api\ApprovalController;
use App\Http\Controllers\Api\CetakanController;
use App\Http\Controllers\Api\ChecklistPerawatanController;
use App\Http\Controllers\Api\SukucadangController;
use App\Http\Controllers\Api\PengecekanController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\JalurController;
use App\Http\Controllers\Api\SetupController;
use App\Http\Controllers\Api\KehandalanController;
use App\Http\Controllers\Api\RoleController;

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

// ->domain('api.wika-beton.co.id/iris-webservice')
Route::name('api.')->namespace('Api')->group(function() {
	Route::get('viewer/{path}', [FileController::class, 'viewer'])->name('file.viewer');
 
	Route::post('approval',			[ApprovalController::class, 'store']);

	Route::get('inventory/{id}', 	[InventoryController::class, 'detail']);
	Route::get('inventory-search/{pat}', 	[InventoryController::class, 'search']);
	Route::post('inventory/{id}/update',	[InventoryController::class, 'update']);

	Route::prefix('perbaikan')->group(function() {
		Route::get('list',			[FPerbaikanController::class, 'index']);
		Route::post('pelapor',		[FPerbaikanController::class, 'pelapor']);
		Route::post('teknisi',		[FPerbaikanController::class, 'teknisi']);
		Route::post('approval',		[FPerbaikanController::class, 'approval']);
	});

	Route::prefix('perawatan')->group(function() {
		Route::get('/',					[FPerawatanController::class, 'index']);
		Route::post('/',				[FPerawatanController::class, 'store']);
		Route::post('teknisi',			[FPerawatanController::class, 'teknisi']);
		Route::post('approval',			[FPerawatanController::class, 'approval']);
	});

	Route::prefix('sukucadang')->group(function() {
		Route::get('/',					[SukucadangController::class, 'index']);
		Route::post('/',				[SukucadangController::class, 'store']);
	});

	Route::prefix('pengecekan')->group(function() {
		Route::post('/',				[PengecekanController::class, 'store']);
	});

	Route::prefix('dashboard')->group(function() {
		Route::get('ownership',			[DashboardController::class, 'ownership'])->name('dashboard.ownership');
		Route::get('age',				[DashboardController::class, 'age'])->name('dashboard.age');
		Route::get('condition',			[DashboardController::class, 'condition'])->name('dashboard.condition');
		Route::post('damage-loc',		[DashboardController::class, 'damageLocation'])->name('dashboard.damage-loc');
	});

	Route::prefix('jalur')->group(function() {
		Route::get('/',				[JalurController::class, 'index']);
	});
	
	Route::prefix('cetakan')->group(function() {
		Route::get('/',				[CetakanController::class, 'index']);
	});

	Route::get('pemenuhan-setup', [SetupController::class, 'index']);
	Route::post('pemenuhan-setup', [SetupController::class, 'submitPemenuhan']);

	Route::post('permohonan-setup',	[SetupController::class, 'submitPermohonan']);

	Route::post('evaluasi-kehandalan',	[KehandalanController::class, 'submitEvaluasi']);

	Route::post('role', [RoleController::class, 'create']);

	Route::get('form-checklist-perawatan/{kd_pat}/{kode}', [ChecklistPerawatanController::class, 'index']);
	Route::post('form-checklist-perawatan', [ChecklistPerawatanController::class, 'store']);
});

