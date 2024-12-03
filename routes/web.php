<?php

use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PublicController::class, "index"])->name("index");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware("auth")->group(function(){
    route::get("/operators", [OperatorController::class, "index"])->name("operators");
    route::get("/operators/create", [OperatorController::class, "create"])->name("operators.create");
    route::post("/operators/create", [OperatorController::class, "store"])->name("operators.store");
    route::get("/operators/edit/{user}", [OperatorController::class, "edit"])->name("operators.edit");
    route::post("/operators/edit/{user}", [OperatorController::class, "update"])->name("operators.update");
    route::get("/operators/delete/{user}", [OperatorController::class, "destroy"])->name("operators.destroy");
});

require __DIR__.'/auth.php';