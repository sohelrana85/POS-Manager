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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('/dailySale', [HomeController::class,'seven_days_sale'])->name('seven.days.sale')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    #role
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    #customer
    Route::resource('customers', CustomerController::class);
    Route::get('All-Customers', [CustomerController::class, 'all_customer']);

    #Setting
    Route::prefix('Setting')->group(function(){
        Route::resource('Business-Setting', BusinessSettingController::class);
        Route::get('Get-Business-Setting-Data', [BusinessSettingController::class, 'get_business_setting_data']);
        #payment-type
        Route::resource('Payment-Type', PaymentTypeController::class);
        Route::get('All-Payment-Type', [PaymentTypeController::class, 'all_payment_type'])->name('payment.type');
    });
    #Supplier
    Route::prefix('Supplier')->group(function(){
        Route::resource('Manage-Suppliers', SupplierController::class)->except('create','show','edit');
        Route::get('All-Supplier', [SupplierController::class, 'all_supplier']);
        Route::get('return-item', [SupplierController::class, 'return_item'])->name('return.item');
        Route::get('due-payment', [SupplierController::class, 'due_payment'])->name('due.payment');

    });
    #Product
    Route::prefix('Product')->group(function(){
        Route::resource('Product', ProductController::class);
        Route::get('All-Product', [ProductController::class,'all_product']);

        Route::get('Print-Barcode', [ProductController::class, 'print_barcode'])->name('print.barcode');

        Route::resource('Unit-Types', UnitTypeController::class);
        Route::get('All-Unit-Type', [UnitTypeController::class, 'all_unit_type']);

        Route::resource('Package-Sizes', PackageSizeController::class)->except('create','show','edit');
        Route::get('All-Package-Size', [PackageSizeController::class, 'all_package_size']);

        Route::resource('Categories', CategoryController::class);
        Route::get('All-Category', [CategoryController::class, 'all_category']);

        Route::resource('Brands', BrandController::class)->except('create','show','edit');
        Route::get('All-Brand', [BrandController::class, 'all_brand']);

    });
    #Purchase
    Route::resource('/Purchase', PurchaseController::class);
    Route::get('/Load-Purchase', [PurchaseController::class, 'load_purchase_data'])->name('manage.purchase');
    #Stock
    Route::get('Add-To-Stock', [StockController::class, 'add_to_stock_page'])->name('add.stock');
    Route::get('All-Purchase', [StockController::class, 'all_purchase']);
    Route::get('Add-To-Stock/{id}', [StockController::class, 'add_to_stock']);
    Route::get('Manage-Stock', [StockController::class, 'manage_stock_page'])->name('manage.stock');
    Route::get('Get-All-Stock', [StockController::class, 'get_all_stock']);
    #sell
    Route::resource('Sell', ProductSellController::class);
    Route::get('/all-sell', [ProductSellController::class, 'all_sell'])->name('all.sell');
    #expense
    Route::resource('Expense-Type', ExpenseTypeController::class);
    Route::get('All_Expense_Type', [ExpenseTypeController::class, 'all_expense_type'])->name('all-expense.type');
    Route::resource('Expense', ExpenseController::class);
    Route::get('All_Expense', [ExpenseController::class, 'all_expense'])->name('all.expense');
    Route::get('Expense-Statement', [ExpenseController::class, 'expense_statement'])->name('expense.statement');


    Route::prefix('Bank')->group(function(){
        Route::resource('Bank-Account', BankAccountController::class);
        Route::get('All-Bank-Account', [BankAccountController::class, 'all_bank_account']);
        Route::resource('Bank-Transaction', BankTransactionController::class);
        Route::get('All-Bank-Transaction', [BankTransactionController::class, 'all_bank_transaction']);
        Route::get('Bank-Ledger', [BankTransactionController::class, 'bank_ledger'])->name('bank.ledger');
        Route::post('Search-Ledger', [BankTransactionController::class,'search_ledger']);
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
    #role all permissions
    Route::get('/role-permissions', [HelperController::class, 'role_all_permissions']);
});

