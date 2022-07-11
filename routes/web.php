<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [TeacherController::class, 'index']);
Route::get('get-Teacher', [TeacherController::class, 'show'])->name('get-Teacher');
Route::post('add-Teacher', [TeacherController::class, 'store'])->name('add-Teacher');
Route::get('edit-Teacher/{id}', [TeacherController::class, 'edit'])->name('edit-Teacher');
Route::post('update-Teacher/{id}', [TeacherController::class, 'update'])->name('update-Teacher');
Route::get('delete-Teacher/{id}', [TeacherController::class, 'destroy'])->name('delete-Teacher');
