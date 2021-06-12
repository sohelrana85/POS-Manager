<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Helper\HelperController;
use App\Http\Controllers\PackageSizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseTypeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitTypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login', 301);

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    #customer
    Route::get('Customer', function(){ return view('pages.customer.manage-customer'); })->name('customer');
    Route::resource('customers', CustomerController::class)->except('create','show','edit');

    #Setting
    Route::prefix('Setting')->group(function(){
        Route::get('Unit-Type', function(){ return view('pages.setting.manage-unit-type'); })->name('unit.type');
        Route::resource('Unit-Types', UnitTypeController::class)->except('create','show','edit');

        Route::get('Unit-Type-Names', [UnitTypeController::class, 'Unit_Type_Names']); //get unit type name
        Route::get('Package-Size', function(){ return view('pages.setting.manage-package-size'); })->name('package.size');
        Route::resource('Package-Sizes', PackageSizeController::class)->except('create','show','edit');

        Route::get('Payment-Type', function(){ return view('pages.setting.manage-payment-type'); })->name('payment.type');
        Route::resource('Purchase-Types', PurchaseTypeController::class)->except('create','show','edit');

        Route::get('Category', function(){ return view('pages.setting.manage-category'); })->name('category');
        Route::resource('Categories', CategoryController::class)->except('create','show','edit');

        Route::get('Brand', function(){ return view('pages.setting.manage-brand'); })->name('brand');
        Route::resource('Brands', BrandController::class)->except('create','show','edit');
    });
    #Supplier
    Route::prefix('Supplier')->group(function(){
        Route::get('Manage-Supplier', function(){ return view('pages.supplier.manage-supplier'); })->name('manage.supplier');
        Route::resource('Manage-Suppliers', SupplierController::class)->except('create','show','edit');

        Route::get('return-item', function(){ return view('pages.supplier.return-item'); })->name('return.item');
        Route::get('due-payment', function(){ return view('pages.supplier.due-payment'); })->name('due.payment');

    });
    #Product
    Route::prefix('Product')->group(function(){
        Route::get('add', function(){ return view('pages.product.add-product'); })->name('add.product');
        Route::post('/add-product', [ProductController::class, 'store']);
        Route::get('Manage', function(){ return view('pages.product.manage-product'); })->name('product.manage');
        Route::get('/loadProducts', [ProductController::class,'index']);
        Route::delete('/Products/{id}', [ProductController::class,'delete']);

    });
    #Purchase
    Route::prefix('Purchase')->group(function(){
        Route::get('Product-Purchase', function(){ return view('pages.purchase.product-purchase'); })->name('product.purchase');
        Route::get('Manage-Purchase', function(){ return view('pages.purchase.manage-purchase'); })->name('manage.purchase');
        Route::resource('/Purchase', PurchaseController::class);


    });
    #Stock
    Route::prefix('Stock')->group(function(){
        Route::get('Add-Stock', function(){ return view('pages.stock.add-stock'); })->name('add.stock');
        Route::get('Manage-Stock', function(){ return view('pages.stock.manage-stock'); })->name('manage.stock');
        Route::get('All-Purchase', [StockController::class, 'all_purchase']);
        Route::get('Add-To-Stock/{id}', [StockController::class, 'add_to_stock']);
        Route::get('Get-All-Stock', [StockController::class, 'get_all_stock']);
    });

        Route::get('print-barcode', function(){ return view('pages.product.print-barcode'); })->name('print.barcode');

    #sell
    Route::prefix('Product')->group(function(){
        Route::get('Sell-Product', function(){ return view('pages.sell.sell-product'); })->name('sell.product');

    });

    #Helper
    Route::get('/getCategory', [HelperController::class, 'get_category']);
    Route::get('/getBrand', [HelperController::class, 'get_brand']);
    Route::get('/getUnitType', [HelperController::class, 'get_unit_type']);
    Route::get('/getPackageSize/{id}', [HelperController::class, 'get_package_size']);
    #product purchase
    Route::get('/getWarehouse', [HelperController::class, 'get_warehouse']);
    Route::get('/getSuppliers', [HelperController::class, 'get_suppliers']);
    Route::get('/getPurchaseStatus', [HelperController::class, 'get_purchase_status']);
    // Route::get('/getPaymentStatus', [HelperController::class, 'get_payment_status']);
    Route::get('/getPaymentType', [HelperController::class, 'get_payment_type']);
    Route::get('/getPurchaseType', [HelperController::class, 'get_purchase_type']);
    Route::get('/getProducts', [HelperController::class, 'get_products']);
    Route::get('/getBankAccounts', [HelperController::class, 'get_bank_account']);

});

