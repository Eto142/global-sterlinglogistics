<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentHistoryController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    try {
        $whatsappNumber = Setting::get('whatsapp_number', '');
    } catch (\Throwable $exception) {
        $whatsappNumber = '';
    }

    return view('home.homepage', [
        'whatsappNumber' => $whatsappNumber,
    ]);
})->name('home');

Route::get('/services', function () {
    return view('home.services');
})->name('services');

Route::get('/track-now', [ShipmentController::class, 'trackForm'])->name('track.form');
Route::post('/track-now', [ShipmentController::class, 'track'])->name('track.submit');

Route::get('/contact', function () {
    return view('home.contact');
})->name('contact');

Route::get('/team', function () {
    return view('home.team');
})->name('team');

Route::get('/about', function () {
    return view('home.about');
})->name('about');




Route::get('/shipment/book', [ShipmentController::class, 'create'])->name('shipment.create');
Route::post('/shipment/book', [ShipmentController::class, 'store'])->name('shipment.store');

Route::get('/shipment/track', [ShipmentController::class, 'trackForm'])->name('shipment.track.form');
Route::post('/shipment/track', [ShipmentController::class, 'track'])->name('shipment.track');

// ✅ DELETE shipment
Route::delete('/shipment/{id}', [ShipmentController::class, 'destroy'])
    ->name('shipment.destroy');

    Route::get('/shipment/{id}/edit', [ShipmentController::class, 'edit'])
    ->name('shipment.edit');

Route::put('/shipment/{id}', [ShipmentController::class, 'update'])
    ->name('shipment.update');


    Route::get('/shipment/download/{awb}', [ShipmentController::class, 'downloadPdf'])
    ->name('shipment.download');

// Live map: returns JSON history for a tracking number
Route::get('/api/shipment/{tracking}/history', [ShipmentController::class, 'historyJson'])
    ->name('shipment.history.json');



// Show shipment history page
Route::get('/shipment/{shipment}/history', [ShipmentHistoryController::class, 'edit'])
    ->name('shipment.history.edit');

// Add a new history entry
Route::post('/shipment/{shipment}/history', [ShipmentHistoryController::class, 'store'])
    ->name('shipment.history.add');


// Edit a specific history entry (update)
Route::put('/shipment/history/{history}', [ShipmentHistoryController::class, 'update'])
    ->name('shipment.history.entry.update');

// Show edit page for a single history entry
Route::get('/shipment/history/{history}/edit', [ShipmentHistoryController::class, 'edithistory'])
    ->name('shipment.history.entry.edit');


// Delete a specific history entry
Route::delete('/shipment/history/{history}', [ShipmentHistoryController::class, 'destroy'])
    ->name('shipment.history.destroy');


// contact route

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

