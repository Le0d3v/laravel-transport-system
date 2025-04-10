<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Auth\TwoFactorAuthController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public
Route::get("/", [PublicController::class, "index"])->name("index");
Route::get("/nosotros", [PublicController::class, "about"])->name("about");
Route::get("/terminales", [PublicController::class, "terminals"])->name("public.terminals");

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

// Trips
Route::middleware("auth")->group(function(){
    route::get("/trips", [TripController::class, "index"])->name("trips");
    route::get("/trips/create", [TripController::class, "create"])->name("trips.create");
    route::post("/trips/create", [TripController::class, "store"])->name("trips.store");
    route::get("/trips/edit/{id}", [TripController::class, "edit"])->name("trips.edit");
    route::post("/trips/edit/{id}", [TripController::class, "update"])->name("trips.update");
    route::get("/trips/delete/{id}", [TripController::class, "destroy"])->name("trips.destroy");
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

// Client
Route::get("/dashboard/show-trips", [ClientController::class, "index"])->name("client.trips.index");
route::get("/dashboard/buy-trip/{id}", [ClientController::class, "buy"])->name("client.trips.buy");
route::get("/dashboard/my-trips", [ClientController::class, "get"])->name("client.trips.get");

// Apis
Route::post('/buscar-viaje', [APIController::class, 'searchTrip'])->name('search.trip');
route::get("/get-trip/{id}", [APIController::class, "getTrip"])->name("trips.trip.get");
Route::post('/comprar-boletos', [APIController::class, 'buy'])->name('client.trips.buy');


Route::get('/two-factor/verify', [TwoFactorController::class, 'showVerifyForm'])->name('two-factor.verify');
Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify.post');

require __DIR__.'/auth.php';