<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseListController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SalesListController;
use App\Http\Controllers\SalesRecordController;
use App\Http\Controllers\PurchaseRecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Login Routes
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Routes for authenticated users
Route::middleware('auth')->group(function () {

  // Logout Route
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


  Route::get('/', [DashboardController::class, 'index'])->name('home');

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

  Route::get('/product', [ProductController::class, 'index'])->name('product.index');
  Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
  Route::post('/product/create', [ProductController::class, 'create'])->name('product.create');
  Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
  Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
  Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

  Route::get('/purchase-order', [PurchaseOrderController::class, 'index'])->name('po.index');
  Route::get('/purchase-order/add', [PurchaseOrderController::class, 'add'])->name('po.add');
  Route::post('/purchase-order/create', [PurchaseOrderController::class, 'create'])->name('po.create');
  Route::get('/purchase-order/edit/{id}', [PurchaseOrderController::class, 'edit'])->name('po.edit');
  Route::put('/purchase-order/update/{id}', [PurchaseOrderController::class, 'update'])->name('po.update');
  Route::get('/purchase-order/delete/{id}', [PurchaseOrderController::class, 'delete'])->name('po.delete');
  Route::get('/purchase-record', [PurchaseRecordController::class, 'index'])->name('po.purchaserecord');

  Route::get('/sales-order', [SalesOrderController::class, 'index'])->name('so.index');
  Route::get('/sales-order//add', [SalesOrderController::class, 'add'])->name('so.add');
  Route::post('/sales-order/create', [SalesOrderController::class, 'create'])->name('so.create');
  Route::get('/sales-order/edit/{id}', [SalesOrderController::class, 'edit'])->name('so.edit');
  Route::put('/sales-order/update/{id}', [SalesOrderController::class, 'update'])->name('so.update');
  Route::get('/sales-order/delete/{id}', [SalesOrderController::class, 'delete'])->name('so.delete');
  Route::get('/sales-record', [SalesRecordController::class, 'index'])->name('so.salesrecord');

  Route::get('/sales/report', [ReportController::class, 'index'])->name('sales.report');

  Route::get('/users', [UserController::class, 'index'])->name('users.index');
  Route::get('/user/add', [UserController::class, 'adduser'])->name('users.adduser');
  Route::post('/user/create', [UserController::class, 'createuser'])->name('users.createuser');
  Route::get('/user/edit/{id}', [UserController::class, 'edituser'])->name('users.edituser');
  Route::put('/user/update/{id}', [UserController::class, 'updateuser'])->name('users.updateuser');
  Route::get('/user/delete/{id}', [UserController::class, 'deleteuser'])->name('users.deleteuser');
});
