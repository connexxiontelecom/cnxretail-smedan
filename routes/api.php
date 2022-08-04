<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all-reminders',  [App\Http\Controllers\API\ReminderController::class, 'allReminders']);

Route::post('/register', [App\Http\Controllers\API\RegisterController::class, 'createAccount']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify'], 'prefix'=>'auth' ], function() {
    Route::post('/dashboard', [App\Http\Controllers\API\DashboardController::class, 'summary']);
    Route::post('/invoices', [App\Http\Controllers\API\InvoiceController::class, 'getInvoices']);
    Route::post('/invoices/create', [App\Http\Controllers\API\InvoiceController::class, 'createInvoice']);
    Route::post('/bills', [App\Http\Controllers\API\BillController::class, 'getBills']);
    Route::get('/contacts', [App\Http\Controllers\API\ContactsController::class, 'allContacts']);
    Route::get('/items', [App\Http\Controllers\API\ProductsController::class, 'getItems']);
});
