<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\LettersController;

Route::get('/', function () {
    return redirect('/letters');
});

Route::get('/letters/export/excel', [LettersController::class, 'exportExcel'])->name('letters.export');
Route::resource('letters', LettersController::class)->except(['create', 'edit', 'show']);

