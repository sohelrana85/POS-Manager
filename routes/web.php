<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankTransactionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\Helper\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageSizeController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSellController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseTypeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitTypeController;
use App\Models\BusinessSetting;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('/dailySale', [HomeController::class,'seven_days_sale'])->name('seven.days.sale')->middleware('auth');

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
        Route::get('Business-Setting', function(){ return view('pages.setting.business-setting'); })->name('business.setting');
        Route::get('Get-Business-Setting', [BusinessSettingController::class, 'index']);
        Route::post('Save-Business-Setting', [BusinessSettingController::class, 'store']);
        Route::post('Update-Business-Setting', [BusinessSettingController::class, 'update']);
        Route::get('Payment-Type', function(){ return view('pages.setting.payment-type'); })->name('payment.type');
        Route::resource('pType', PaymentTypeController::class)->except('create','show','edit');
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

        Route::get('Unit-Type', function(){ return view('pages.product.unit-type'); })->name('unit.type');
        Route::resource('Unit-Types', UnitTypeController::class)->except('create','show','edit');

        Route::get('Unit-Type-Names', [UnitTypeController::class, 'Unit_Type_Names']); //get unit type name
        Route::get('Package-Size', function(){ return view('pages.product.package-size'); })->name('package.size');
        Route::resource('Package-Sizes', PackageSizeController::class)->except('create','show','edit');

        Route::get('Category', function(){ return view('pages.product.category'); })->name('category');
        Route::resource('Categories', CategoryController::class)->except('create','show','edit');

        Route::get('Brand', function(){ return view('pages.product.brand'); })->name('brand');
        Route::resource('Brands', BrandController::class)->except('create','show','edit');

    });
    #Purchase
    Route::prefix('Purchase')->group(function(){
        Route::get('Product-Purchase', function(){ return view('pages.purchase.product-purchase'); })->name('product.purchase');
        Route::get('Manage-Purchase', function(){ return view('pages.purchase.manage-purchase'); })->name('manage.purchase');
        Route::get('print-barcode', function(){ return view('pages.product.print-barcode'); })->name('print.barcode');
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

    #sell
    Route::prefix('Product')->group(function(){
        Route::get('Product-Sell', function(){ return view('pages.sell.product-sell'); })->name('product.sell');
        Route::get('Manage-Sell', function(){ return view('pages.sell.manage-sell'); })->name('manage.sell');
        Route::resource('Sell', ProductSellController::class);

    });
    #expense
    Route::prefix('Expense')->group(function(){
        Route::get('Manage-Type', function(){ return view('pages.expense.manage-type'); })->name('manage.type');
        Route::resource('Type', ExpenseTypeController::class);

        Route::get('Manage-Expense', function(){ return view('pages.expense.manage-expense'); })->name('manage.expense');
        Route::resource('Expense', ExpenseController::class);
        Route::get('Expense-Statement', function(){ return view('pages.expense.expense-statement'); })->name('expense.statement');

    });
    Route::prefix('Bank')->group(function(){
        Route::get('Manage-Bank', function(){ return view('pages.bank.manage-bank'); })->name('manage.bank');
        Route::resource('Account', BankAccountController::class)->except('create','show','edit');
        Route::get('Bank-Transaction', function(){ return view('pages.bank.bank-transaction'); })->name('bank.transaction');
        Route::get('Bank-Ledger', function(){ return view('pages.bank.bank-ledger'); })->name('bank.ledger');
        Route::get('Transaction', [BankTransactionController::class,'index']);
        Route::post('Transaction', [BankTransactionController::class,'store']);
        Route::delete('Transaction/{id}', [BankTransactionController::class,'destroy']);
        Route::post('Ledger', [BankTransactionController::class,'search_ledger']);
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
    #Route::get('/getPaymentStatus', [HelperController::class, 'get_payment_status']);
    Route::get('/getPaymentType', [HelperController::class, 'get_payment_type']);
    Route::get('/getPurchaseType', [HelperController::class, 'get_purchase_type']);
    Route::get('/getProducts', [HelperController::class, 'get_products']);
    Route::get('/getProductsFromSell', [HelperController::class, 'get_products_from_sell']);
    Route::get('/getBankAccounts', [HelperController::class, 'get_bank_account']);
    #sell product
    Route::get('/Get-Last-Invoice-No', [HelperController::class, 'get_last_invoice_no']);
    Route::get('/getCustomers', [HelperController::class, 'get_customers']);
    Route::get('/Product-Search/{value}', [HelperController::class, 'product_search']);
    Route::get('/Product-Search/{value}', [HelperController::class, 'product_search']);
    #Expense
    Route::get('/getExpenseType', [HelperController::class, 'get_expense_type']);
    #get total balance of bank account
    Route::get('/getTotalBalance', [HelperController::class, 'get_total_balance']);

});

