<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/',[FormController::class,'index'])->name('forms.index');
Route::get('/forms/create',[FormController::class,'create'])->name('forms.create');
Route::post('/forms/store',[FormController::class,'store'])->name('forms.store');
Route::get('forms/{id}/edit',[FormController::class,'edit'])->name('forms.edit');
Route::put('forms/{id}/update',[FormController::class,'update'])->name('forms.update');
Route::delete('forms/{id}/delete',[FormController::class,'destroy'])->name('forms.destroy');
Route::get('forms/{id}/show',[FormController::class,'show'])->name('forms.show');
