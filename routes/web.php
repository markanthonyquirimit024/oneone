<?php

use App\Http\Controllers\StudentViewController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', [StudentViewController::class, 'index'])->name('index');
Route::get('/students/create', [StudentViewController::class, 'createStudent'])->name('create');
Route::post('/students/create', [StudentViewController::class, 'store'])->name('store');
Route::get('/students/{id}', [StudentViewController::class, 'show'])->name('show');
Route::put('/students/{id}', [StudentViewController::class, 'update'])->name('update');
Route::delete('/students/delete/{id}', [StudentViewController::class, 'destroy'])->name('destroy');
