<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Auth\TwoFactorAuthController;

// Public
Route::get("/", [PublicController::class, "index"])->name("index");
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get("/about", [PublicController::class, "about"])->name("about");
Route::get("/terminals", [PublicController::class, "terminals"])->name("terminals");

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Operators
Route::middleware("auth")->group(function(){
    route::get("/operators", [OperatorController::class, "index"])->name("operators");
    route::get("/operators/create", [OperatorController::class, "create"])->name("operators.create");
    route::post("/operators/create", [OperatorController::class, "store"])->name("operators.store");
    route::get("/operators/edit/{user}", [OperatorController::class, "edit"])->name("operators.edit");
    route::post("/operators/edit/{user}", [OperatorController::class, "update"])->name("operators.update");
    route::get("/operators/delete/{user}", [OperatorController::class, "destroy"])->name("operators.destroy");
});

// Trucks
Route::middleware("auth")->group(function(){
    route::get("/trucks", [TruckController::class, "index"])->name("trucks.index");
    route::get("/trucks/create", [TruckController::class, "create"])->name("trucks.create");
    route::post("/trucks/create", [TruckController::class, "store"])->name("trucks.store");
    route::get("/trucks/edit/{id}", [TruckController::class, "edit"])->name("trucks.edit");
    route::post("/trucks/edit/{id}", [TruckController::class, "update"])->name("trucks.update");
    route::get("/trucks/delete/{id}", [TruckController::class, "destroy"])->name("trucks.destroy");
});

// Terminals
Route::middleware("auth")->group(function(){
    route::get("/terminals", [TerminalController::class, "index"])->name("terminals.index");
    route::get("/terminals/create", [TerminalController::class, "create"])->name("terminals.create");
    route::post("/terminals/create", [TerminalController::class, "store"])->name("terminals.store");
    route::get("/terminals/edit/{id}", [TerminalController::class, "edit"])->name("terminals.edit");
    route::post("/terminals/edit/{id}", [TerminalController::class, "update"])->name("terminals.update");
    route::get("/terminals/delete/{id}", [TerminalController::class, "destroy"])->name("terminals.destroy");
});


// Drivers
Route::middleware("auth")->group(function(){
    route::get("/drivers", [DriverController::class, "index"])->name("drivers.index");
    route::get("/drivers/create", [DriverController::class, "create"])->name("drivers.create");
    route::post("/drivers/create", [DriverController::class, "store"])->name("drivers.store");
    route::get("/drivers/edit/{driver}", [DriverController::class, "edit"])->name("drivers.edit");
    route::get("/drivers/delete/{id}", [DriverController::class, "destroy"])->name("drivers.destroy");
    route::post("/drivers/edit/{driver}", [DriverController::class, "update"])->name("driver.change");
});


Route::get('/two-factor/verify', [TwoFactorController::class, 'showVerifyForm'])->name('two-factor.verify');
Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify.post');

require __DIR__.'/auth.php';