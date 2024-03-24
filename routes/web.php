<?php

use App\Http\Controllers\ChecklistPerawatanController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\IkDocumentController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\KodeLiniController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsedMaterialController;
use App\Http\Middleware\EnsureSessionIsValid;
use App\Http\Controllers\Api\DashboardController as ApiDashboardController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistPerawatanAssignController;

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

Route::domain(env('PRIVATE_DOMAIN', ''))->middleware([EnsureSessionIsValid::class])->group(function () {
	Route::get('test', function(){
		dd(session()->all());
		// return view('tabel');
	});
	Route::get('/', 			[DashboardController::class, 'index']);
	Route::get('/dashboard',	[DashboardController::class, 'index'])->name('dashboard.ownership');

    Route::prefix('dashboard-api')->group(function() {
		Route::get('ownership',			[ApiDashboardController::class, 'ownership'])->name('dashboardapi.ownership');
		Route::get('age',				[ApiDashboardController::class, 'age'])->name('dashboardapi.age');
		Route::get('condition',			[ApiDashboardController::class, 'condition'])->name('dashboardapi.condition');
		Route::post('damage-loc',		[ApiDashboardController::class, 'damageLocation'])->name('dashboardapi.damage-loc');
	});


	Route::get('/inventory/data',	[InventoryController::class, 'data'])->name('inventory.data');
	Route::resource('inventory',	InventoryController::class);

	Route::post('/ikdocument/destroy',	[IkDocumentController::class, 'destroy'])->name('ikdocument.destroy');
	Route::get('/ikdocument/data',	[IkDocumentController::class, 'data'])->name('ikdocument.data');
	Route::resource('ikdocument',	IkDocumentController::class)->except([
		'destroy'
	]);

	Route::get('/monitoring/data',	[MonitoringController::class, 'data'])->name('monitoring.data');
	Route::resource('monitoring',  MonitoringController::class)->except([
		'destroy'
	]);

	Route::get('/kodelini/data',	[KodeLiniController::class, 'data'])->name('kodelini.data');
	Route::resource('kodelini',  KodeLiniController::class)->except([
		'destroy'
	]);

	Route::get('/sukucadang/data',	[SukuCadangController::class, 'data'])->name('sukucadang.data');
	Route::resource('sukucadang',  SukuCadangController::class)->except([
		'destroy'
	]);

	Route::group(['prefix' => 'report', 'as' => 'report.'], function(){
		Route::get('/inventory',		[ReportController::class, 'inventory'])->name('inventory');
		Route::post('/inventory',		[ReportController::class, 'inventoryExport'])->name('inventory-export');

		Route::get('/age',		[ReportController::class, 'age'])->name('age');
		Route::post('/age',		[ReportController::class, 'ageExport'])->name('age-export');

		Route::get('/qrcode',		[ReportController::class, 'qrcode'])->name('qrcode');
		Route::post('/qrcode',		[ReportController::class, 'qrcodePdf'])->name('qrcode-pdf');

		Route::get('/qrcode-sukucadang',  [ReportController::class, 'qrcodeSukucadang'])->name('qrcode-sukucadang');
		Route::post('/qrcode-sukucadang', [ReportController::class, 'qrcodeSukucadangPdf'])->name('qrcode-sukucadang-pdf');

		Route::get('/rekap-inventory',	[ReportController::class, 'rekapInventory'])->name('rekap-inventory');
		Route::post('/rekap-inventory',	[ReportController::class, 'rekapInventoryExport'])->name('rekap-inventory-export');
	});

	Route::get('/usedmaterial/data',	[UsedMaterialController::class, 'data'])->name('usedmaterial.data');
	Route::get('/usedmaterial/kodelini',[UsedMaterialController::class, 'findKodelini'])->name('usedmaterial.kodelini');
	Route::resource('usedmaterial',  UsedMaterialController::class)->except([
		'destroy'
	]);

	Route::controller(RoleController::class)->prefix('setting-akses-menu')->name('setting.akses.menu.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/setting/{id}', 'setting')->name('setting');
        Route::post('/update', 'update_setting')->name('update.setting');
		Route::post('/tree-data', 'tree_data')->name('tree.data');
        Route::get('/delete-setting/{id}', 'delete_setting')->name('delete.setting');
    });

	Route::group(['prefix' => 'checklist-perawatan', 'as' => 'checklist-perawatan.'], function(){
        Route::resource('/', ChecklistPerawatanController::class)->except(['show', 'destroy'])->parameters(['' => 'id']);
        Route::get('/data', [ChecklistPerawatanController::class, 'data'])->name('data');
        Route::post('/destroy',	[ChecklistPerawatanController::class, 'destroy'])->name('destroy');
    });

	Route::group(['prefix' => 'checklist-perawatan-assign', 'as' => 'checklist-perawatan-assign.'], function(){
        Route::resource('/', ChecklistPerawatanAssignController::class)->except(['destroy', 'show'])->parameters(['' => 'id']);
        Route::get('data', [ChecklistPerawatanAssignController::class, 'data'])->name('data');
        Route::post('destroy',	[ChecklistPerawatanAssignController::class, 'destroy'])->name('destroy');
    });

	Route::controller(ChecklistController::class)->prefix('checklist')->name('checklist.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/view/{id}', 'view')->name('view');
    });
});

