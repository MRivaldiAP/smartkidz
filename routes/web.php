<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyBookingController;
use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\FrontImageController;
use App\Http\Controllers\RequestAgentController;
use App\Http\Controllers\RedeemHistoryController;
use App\Http\Controllers\RedeemConfirmationController;

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

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::resource('dashboard', DashboardController::class);

Route::post('request-agent/approval', [RequestAgentController::class, 'approval'])->name('request.approval');
Route::resource('request-agent', RequestAgentController::class);
Route::resource('agent', AgentController::class);

Route::post('jadwal/edit-limit', [JadwalController::class, 'editLimit'])->name('jadwal.edit-limit');
Route::get('jadwal/details/{id}', [JadwalController::class, 'details'])->name('jadwal.details');
Route::resource('jadwal', JadwalController::class);
Route::resource('produk', ProdukController::class);

Route::get('booking/print-invoice/{id}', [BookingController::class, 'getInvoice'])->name('booking.print-invoice');
Route::post('booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::get('booking/invoice/{id}', [BookingController::class, 'invoice'])->name('booking.invoice');
Route::post('booking/step2', [BookingController::class, 'step2'])->name('booking.step2');
Route::post('booking/step3', [BookingController::class, 'step3'])->name('booking.step3');
Route::get('booking/pick/{id}', [BookingController::class, 'pick'])->name('booking.pick');
Route::resource('booking', BookingController::class);
Route::post('my-booking/payment-counter', [MyBookingController::class, 'paymentCounter'])->name('mybooking.payment-counter');
Route::post('my-booking/payment', [MyBookingController::class, 'payment'])->name('mybooking.payment');
Route::post('my-booking/pay-at-counter', [MyBookingController::class, 'payCounter'])->name('mybooking.pay');
Route::get('my-booking/pay/{id}', [MyBookingController::class, 'pay'])->name('mybooking.pay');
Route::resource('my-booking', MyBookingController::class);

Route::post('redeem/redeem-confirmation/approval', [RedeemConfirmationController::class, 'approval'])->name('redeem.approval');
Route::resource('redeem-confirmation', RedeemConfirmationController::class);
Route::get('redeem/req', [RedeemController::class, 'indexReq'])->name('redeem.req');
Route::resource('redeem', RedeemController::class);
Route::resource('redeem-history', RedeemHistoryController::class);

Route::resource('admin', AdminController::class);

Route::resource('report', ReportController::class);

Route::get('kirim-email', [KirimEmailController::class, 'kirim'])->name('kirim.email');

Route::resource('front', FrontImageController::class);

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

