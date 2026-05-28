<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/chat/{customer}', [ChatController::class, 'index'])->name('chat.index');
Route::post('/send-message', [ChatController::class, 'send'])
    ->name('chat.sendmessage');

Route::get('/pay/{invoice}', [PaymentController::class, 'pay'])->name('pay');
Route::post('/webhook', [WebhookController::class, 'handle']);

// Invoice routes
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show']);

Route::get('/payment/success', function () {
    return view('payment.success');
})->name('payment.success');

Route::get('/payment/cancel', function () {
    return 'Payment cancelled.';
})->name('payment.cancel');
