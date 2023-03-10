<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/invoice/export',[InvoiceController::class, 'export'])->name('invoices.export')->middleware('auth');
Route::get('/invoice/import',[InvoiceController::class, 'import'])->name('invoices.import')->middleware('auth');
Route::post('/invoice/import',[InvoiceController::class, 'importStore'])->name('invoices.importStore')->middleware('auth');

Route::get('/invoice/prueba',[InvoiceController::class, 'importCsv'])->name('invoices.importcsv')->middleware('auth');
