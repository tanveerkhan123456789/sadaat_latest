<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CustomerGroupController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\POSController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard')->middleware('auth:admin');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles'])->middleware('auth:admin');
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users'])->middleware('auth:admin');
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins'])->middleware('auth:admin');


    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit')->middleware('auth:admin');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request')->middleware('auth:admin');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update')->middleware('auth:admin');
});
Route::get('/all/purchses/ajaxdata', 'Backend\PurchaseController@qtydata')->name('admin.allpurchases.ajax')->middleware('auth:admin');

//warehouses routes
Route::get('/ware-houses', 'Backend\WareHouseController@WareHouse')->name('admin.warehouse')->middleware('auth:admin');
Route::post('/create-ware-houses', 'Backend\WareHouseController@WareHouseCreate')->name('admin.warehouse.create')->middleware('auth:admin');
Route::post('/update-ware-houses', 'Backend\WareHouseController@WareHouseUpdate')->name('admin.warehouse.update')->middleware('auth:admin');
Route::get('/delete-ware-houses/{id}', 'Backend\WareHouseController@WareHouseDelete')->name('admin.warehouse.delete')->middleware('auth:admin');
//brands routes
Route::get('/brands', 'Backend\BrandController@Brand')->name('admin.brand')->middleware('auth:admin');
Route::post('/create-brand', 'Backend\BrandController@BrandStore')->name('admin.brand.create')->middleware('auth:admin');
Route::post('/update-brand', 'Backend\BrandController@BrandUpdate')->name('admin.brand.update')->middleware('auth:admin');
Route::get('/delete-brand/{id}', 'Backend\BrandController@BrandDelete')->name('admin.brand.delete')->middleware('auth:admin');

//unit routes
Route::get('/units', 'Backend\UnitController@Unit')->name('admin.unit');
Route::post('/create-units', 'Backend\UnitController@UnitStore')->name('admin.unit.create')->middleware('auth:admin');
Route::post('/update-unit', 'Backend\UnitController@UnitUpdate')->name('admin.unit.update')->middleware('auth:admin');
Route::get('/delete-unit/{id}', 'Backend\UnitController@UnitDelete')->name('admin.unit.delete')->middleware('auth:admin');
//catagory routes

Route::get('/catagories', 'Backend\CatagoryController@Catagory')->name('admin.catagory')->middleware('auth:admin');
Route::post('/create-catagory', 'Backend\CatagoryController@CatagoryStore')->name('admin.catagory.create')->middleware('auth:admin');
Route::post('/update-catagory', 'Backend\CatagoryController@CatagoryUpdate')->name('admin.catagory.update')->middleware('auth:admin');
Route::get('/delete-catagory/{id}', 'Backend\CatagoryController@CatagoryDelete')->name('admin.catagory.delete')->middleware('auth:admin');

//product routes
Route::get('/products', 'Backend\ProductController@Product')->name('admin.product')->middleware('auth:admin');
Route::post('/create-product', 'Backend\ProductController@ProductStore')->name('admin.product.create')->middleware('auth:admin');
Route::post('/update-product', 'Backend\ProductController@ProductUpdate')->name('admin.product.update')->middleware('auth:admin');
Route::get('/delete-product/{id}', 'Backend\ProductController@ProductDelete')->name('admin.product.delete')->middleware('auth:admin');

//sale routes
Route::get('/sales', 'Backend\SaleController@Sale')->name('admin.sale')->middleware('auth:admin');
Route::get('/add-sales', 'Backend\SaleController@addsaleview')->name('admin.add.sales')->middleware('auth:admin');

Route::post('/create-sale', 'Backend\SaleController@saleStore')->name('admin.sale.store')->middleware('auth:admin');
Route::get('/sale-update/{id}', 'Backend\SaleController@SaleUpdate')->name('admin.sale.update')->middleware('auth:admin');
Route::post('/sale-update-data/{id}', 'Backend\SaleController@saleStoreupdatedata')->name('admin.sale.update.data')->middleware('auth:admin');
Route::any('/sales-report', 'Backend\SaleController@SaleReport')->name('admin.sale.report')->middleware('auth:admin')->middleware('auth:admin');

Route::post('/update-product', 'Backend\ProductController@ProductUpdate')->name('admin.product.update')->middleware('auth:admin');
Route::get('/delete-product/{id}', 'Backend\ProductController@ProductDelete')->name('admin.product.delete')->middleware('auth:admin');


// Supplier Routes
Route::get('create-supplier', [SupplierController::class, 'createSupplier'])->name('create.supplier')->middleware('auth:admin');
Route::get('get-supplier', [SupplierController::class, 'getSupplier'])->name('get.supplier')->middleware('auth:admin');
Route::post('supplier-store', [SupplierController::class, 'supplierStore'])->name('supplier.store')->middleware('auth:admin');
Route::get('supplier-edit', [SupplierController::class, 'supplierEdit'])->name('supplier.edit')->middleware('auth:admin');
Route::post('supplier-update', [SupplierController::class, 'supplierUpdate'])->name('supplier.update')->middleware('auth:admin');
Route::get('supplier-delete', [SupplierController::class, 'supplierDelete'])->name('supplier.delete')->middleware('auth:admin');


// Customer Group Routes
Route::get('create-customer-group', [CustomerGroupController::class, 'createCustomerGroup'])->name('create.customer.group')->middleware('auth:admin');
Route::get('get-customer-group', [CustomerGroupController::class, 'getCustomerGroup'])->middleware('auth:admin');
Route::post('customer-group-store', [CustomerGroupController::class, 'customerGroupStore'])->middleware('auth:admin');
Route::get('customer-group-edit', [CustomerGroupController::class, 'customerGroupEdit'])->middleware('auth:admin');
Route::post('customer-group-update', [CustomerGroupController::class, 'customerGroupUpdate'])->middleware('auth:admin');
Route::get('customer-group-delete', [CustomerGroupController::class, 'customerGroupDelete'])->middleware('auth:admin');


// Customer Routes
Route::get('create-customer', [CustomerController::class, 'createCustomer'])->name('create.customer')->middleware('auth:admin');
Route::get('get-customer', [CustomerController::class, 'getCustomer'])->middleware('auth:admin')->middleware('auth:admin');
Route::post('customer-store', [CustomerController::class, 'customerStore'])->middleware('auth:admin')->middleware('auth:admin');
Route::get('customer-edit', [CustomerController::class, 'customerEdit'])->middleware('auth:admin')->middleware('auth:admin');
Route::post('customer-update', [CustomerController::class, 'customerUpdate'])->middleware('auth:admin')->middleware('auth:admin');
Route::get('customer-delete', [CustomerController::class, 'customerDelete'])->middleware('auth:admin')->middleware('auth:admin');


// Purchase Routes
Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase')->middleware('auth:admin');
Route::get('create-purchase', [PurchaseController::class, 'createPurchase'])->name('create.purchase')->middleware('auth:admin');
Route::post('store-purchase', [PurchaseController::class, 'storPurchase']);
Route::get('/purchase-update/{id}', 'Backend\PurchaseController@updatePurchase')->name('admin.purchase.update')->middleware('auth:admin');
Route::post('/purchase-update/{id}', 'Backend\PurchaseController@updatePurchaseData')->name('admin.purchase.update.data')->middleware('auth:admin');
Route::any('report-purchases', [PurchaseController::class, 'reportpurchases'])->name('purchase.report')->middleware('auth:admin');

Route::get('pos', [POSController::class, 'index'])->name('pos')->middleware('auth:admin');
Route::post('quick-customer-store', [POSController::class, 'quickCustomerStore'])->middleware('auth:admin');

Route::get('get-product-detail', [PurchaseController::class, 'getProductDetail'])->middleware('auth:admin');