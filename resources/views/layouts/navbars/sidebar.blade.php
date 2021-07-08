<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ __('POS Manager') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @can('dashboard.view')
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a style="padding: 5px 10px;" class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @endcan

            <hr>
            {{-- //user management --}}
            @if (auth()->user()->can('role.view') || auth()->user()->can('row.create') || auth()->user()->can('row.edit') || auth()->user()->can('row.delete') || auth()->user()->can('user.view') || auth()->user()->can('user.create') || auth()->user()->can('user.edit') || auth()->user()->can('user.delete'))
            <li class="nav-item {{ ($activePage == 'roleManager' || $activePage == 'UserManager') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#role" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    <p>User Management
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activePage == 'roleManager' || $activePage == 'UserManager' ? ' show' : '' }}" id="role">
                    <ul class="nav">
                        @if (auth()->user()->can('role.view') || auth()->user()->can('row.create') || auth()->user()->can('row.edit') || auth()->user()->can('row.delete'))
                        <li class="nav-item{{ $activePage == 'roleManager' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('role.index')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Role</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('user.view') || auth()->user()->can('user.create') || auth()->user()->can('user.edit') || auth()->user()->can('user.delete'))
                        <li class="nav-item{{ $activePage == 'UserManager' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage User</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- customer --}}
            @if (auth()->user()->can('customer.view') || auth()->user()->can('customer.create') || auth()->user()->can('customer.edit') || auth()->user()->can('customer.delete'))
            <li class="nav-item {{ ($activePage == 'customer') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#customer" aria-expanded="false">
                    <i class="fa fa-user-plus"></i>
                    <p>Customer
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activePage == 'customer' ? ' show' : '' }}" id="customer">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'customer' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('customers.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Customer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            {{-- supplier --}}
            @if (auth()->user()->can('supplier.view') || auth()->user()->can('supplier.create') || auth()->user()->can('supplier.edit') || auth()->user()->can('supplier.delete') || auth()->user()->can('supplier.return') || auth()->user()->can('supplier.due-payment'))
            <li class="nav-item {{ ($activePage == 'manage-supplier' || $activePage == 'due-payment' || $activePage == 'return-item') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#supplier" aria-expanded="false">
                    <i class="fa fa-truck"></i>
                    <p>Supplier
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'manage-supplier' || $activePage == 'due-payment' || $activePage == 'return-item')  ? ' show' : '' }}" id="supplier">
                    <ul class="nav">
                        @if (auth()->user()->can('supplier.view') || auth()->user()->can('supplier.create') || auth()->user()->can('supplier.edit') || auth()->user()->can('supplier.delete'))
                        <li class="nav-item{{ $activePage == 'manage-supplier' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Manage-Suppliers.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Supplier</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('supplier.due-payment'))
                        <li class="nav-item{{ $activePage == 'due-payment' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('due.payment') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Due Payment</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('supplier.return'))
                        <li class="nav-item{{ $activePage == 'return-item' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('return.item') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Return Items</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- product --}}
            @if (auth()->user()->can('product.view') || auth()->user()->can('product.create') || auth()->user()->can('product.edit') || auth()->user()->can('product.delete') || auth()->user()->can('print-barcode') || auth()->user()->can('unit.view') || auth()->user()->can('unit.create') || auth()->user()->can('unit.edit') || auth()->user()->can('unit.delete') || auth()->user()->can('package-size.view') || auth()->user()->can('package-size.create') || auth()->user()->can('package-size.edit') || auth()->user()->can('package-size.delete') || auth()->user()->can('category.view') || auth()->user()->can('category.create') || auth()->user()->can('category.edit') || auth()->user()->can('category.delete') || auth()->user()->can('brand.view') || auth()->user()->can('brand.create') || auth()->user()->can('brand.edit') || auth()->user()->can('brand.delete'))
            <li class="nav-item {{ ($activePage == 'add-product' || $activePage == 'manage-product' || $activePage == 'print-barcode' || $activePage == 'unitType' || $activePage == 'PackageSize' || $activePage == 'Category' || $activePage == 'Brand') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#product" aria-expanded="false">
                    <i class="fas fa-database"></i>
                    <p>product
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'add-product' || $activePage == 'manage-product' || $activePage == 'print-barcode' || $activePage == 'unitType' || $activePage == 'PackageSize' || $activePage == 'Category' || $activePage == 'Brand')  ? ' show' : '' }}" id="product">
                    <ul class="nav">
                        @can('product.create')
                        <li class="nav-item{{ $activePage == 'add-product' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Product.create') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Add Product</span>
                            </a>
                        </li>
                        @endcan
                        @if (auth()->user()->can('product.view') || auth()->user()->can('product.edit') || auth()->user()->can('product.delete'))
                        <li class="nav-item{{ $activePage == 'manage-product' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Product.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Product</span>
                            </a>
                        </li>
                        @endif
                        @can('print-barcode')
                        <li class="nav-item{{ $activePage == 'print-barcode' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('print.barcode') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Print Barcode</span>
                            </a>
                        </li>
                        @endcan
                        @if (auth()->user()->can('unit.view') || auth()->user()->can('unit.create') || auth()->user()->can('unit.edit') || auth()->user()->can('unit.delete'))
                        <li class="nav-item{{ $activePage == 'unitType' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Unit-Types.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Unit Type</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('package-size.view') || auth()->user()->can('package-size.create') || auth()->user()->can('package-size.edit') || auth()->user()->can('package-size.delete'))
                        <li class="nav-item{{ $activePage == 'PackageSize' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Package-Sizes.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Package Size</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('category.view') || auth()->user()->can('category.create') || auth()->user()->can('category.edit') || auth()->user()->can('category.delete'))
                        <li class="nav-item{{ $activePage == 'Category' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Categories.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Category</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('brand.view') || auth()->user()->can('brand.create') || auth()->user()->can('brand.edit') || auth()->user()->can('brand.delete'))
                        <li class="nav-item{{ $activePage == 'Brand' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Brands.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Brand</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- purchase --}}
            @if (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') || auth()->user()->can('purchase.edit') || auth()->user()->can('purchase.delete'))
            <li class="nav-item {{ ($activePage == 'manage-purchase' || $activePage == 'product-purchase') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#purchase" aria-expanded="false">
                    <i class="fa fa-cart-plus"></i>
                    <p>Purchase
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'manage-purchase' || $activePage == 'product-purchase')  ? ' show' : '' }}" id="purchase">
                    <ul class="nav">
                        @can('purchase.create')
                        <li class="nav-item{{ $activePage == 'product-purchase' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Purchase.create') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Product Purchase</span>
                            </a>
                        </li>
                        @endcan
                        @if (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.edit') || auth()->user()->can('purchase.delete'))
                        <li class="nav-item{{ $activePage == 'manage-purchase' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('Purchase.index')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Purchase</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- stock --}}
            @if (auth()->user()->can('stock.view') || auth()->user()->can('stock.create') || auth()->user()->can('stock.edit') || auth()->user()->can('stock.delete'))
            <li class="nav-item {{ ($activePage == 'manage-stock') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#stock" aria-expanded="false">
                    <i class="fa fa-palette"></i>
                    <p>Stock
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'add-stock' || $activePage == 'manage-stock')  ? ' show' : '' }}" id="stock">
                    <ul class="nav">
                        @can('stock.add')
                        <li class="nav-item{{ $activePage == 'add-stock' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('add.stock') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Add To Stock</span>
                            </a>
                        </li>
                        @endcan
                        @can('stock.view')
                        <li class="nav-item{{ $activePage == 'manage-stock' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('manage.stock') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">List Stock</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif

            {{-- sell --}}
            @if (auth()->user()->can('sell.view') || auth()->user()->can('sell.create') || auth()->user()->can('sell.edit') || auth()->user()->can('sell.delete'))
            <li class="nav-item {{ ($activePage == 'product-sell'|| $activePage == 'manage-sell') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#sell" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Sell
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'product-sell' || $activePage == 'manage-sell')  ? ' show' : '' }}" id="sell">
                    <ul class="nav">
                        @can('sell.create')
                        <li class="nav-item{{ $activePage == 'product-sell' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Sell.create') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Product Sell</span>
                            </a>
                        </li>
                        @endcan
                        @if (auth()->user()->can('sell.view') || auth()->user()->can('sell.edit') || auth()->user()->can('sell.delete'))
                        <li class="nav-item{{ $activePage == 'manage-sell' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Sell.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Sell</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- Expense --}}
            @if (auth()->user()->can('expense-type.view') || auth()->user()->can('expense-type.create') || auth()->user()->can('expense-type.edit') || auth()->user()->can('expense-type.delete') || auth()->user()->can('expense.view') || auth()->user()->can('expense.create') || auth()->user()->can('expense.edit') || auth()->user()->can('expense.delete') || auth()->user()->can('expense.statement'))
            <li class="nav-item {{ ($activePage == 'expense-type' || $activePage == 'manage-expense' || $activePage == 'expense-statement') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#expense" aria-expanded="false">
                    <i class="fas fa-dollar-sign"></i>
                    <p>Expense
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'expense-type' || $activePage == 'manage-expense' || $activePage == 'expense-statement')  ? ' show' : '' }}" id="expense">
                    <ul class="nav">
                        @if (auth()->user()->can('expense-type.view') || auth()->user()->can('expense-type.create') || auth()->user()->can('expense-type.edit') || auth()->user()->can('expense-type.delete'))
                        <li class="nav-item{{ $activePage == 'expense-type' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('Expense-Type.index')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Expense Type</span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->can('expense.view') || auth()->user()->can('expense.create') || auth()->user()->can('expense.edit') || auth()->user()->can('expense.delete'))
                        <li class="nav-item{{ $activePage == 'manage-expense' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('Expense.index')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Expense</span>
                            </a>
                        </li>
                        @endif
                        @can('expense.statement')
                        <li class="nav-item{{ $activePage == 'expense-statement' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('expense.statement')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Expense Statement</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif

            {{-- Bank --}}
            @if (auth()->user()->can('bank-account.view') || auth()->user()->can('bank-account.create') || auth()->user()->can('bank-account.edit') || auth()->user()->can('bank-account.delete') || auth()->user()->can('bank-transaction.view') || auth()->user()->can('bank-transaction.create') || auth()->user()->can('bank-transaction.edit') || auth()->user()->can('bank-transaction.delete') || auth()->user()->can('bank-transaction.ledger'))
            <li class="nav-item {{ ($activePage == 'manage-bank'|| $activePage == 'bank-transaction' || $activePage == 'bank-ledger') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#bank" aria-expanded="false">
                    <i class="fas fa-university"></i>
                    <p>Bank
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'manage-bank' || $activePage == 'bank-transaction' || $activePage == 'bank-ledger')  ? ' show' : '' }}" id="bank">
                    <ul class="nav">
                        @if (auth()->user()->can('bank-account.view') || auth()->user()->can('bank-account.create') || auth()->user()->can('bank-account.edit') || auth()->user()->can('bank-account.delete'))
                        <li class="nav-item{{ $activePage == 'manage-bank' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Bank-Account.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Bank</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('bank-transaction.view') || auth()->user()->can('bank-transaction.create') || auth()->user()->can('bank-transaction.edit') || auth()->user()->can('bank-transaction.delete'))
                        <li class="nav-item{{ $activePage == 'bank-transaction' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Bank-Transaction.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Bank Transaction</span>
                            </a>
                        </li>
                        @endif
                        @can('bank-transaction.ledger')
                        <li class="nav-item{{ $activePage == 'bank-ledger' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('bank.ledger') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Bank Ledger</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif

            {{-- <li class="nav-item {{ ($activePage == 'sell-product') ? ' active' : '' }}">
            <a class="nav-link collapsed" data-toggle="collapse" href="#report" aria-expanded="false">
                <i class="far fa-list-alt"></i>
                <p>Report
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ ($activePage == 'sell-product')  ? ' show' : '' }}" id="report">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="fas fa-minus"></i>
                            <span class="sidebar-normal">Purchase Report</span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="fas fa-minus"></i>
                            <span class="sidebar-normal">Sell Report</span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="fas fa-minus"></i>
                            <span class="sidebar-normal">Due Report</span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="fas fa-minus"></i>
                            <span class="sidebar-normal">Closing Report</span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="fas fa-minus"></i>
                            <span class="sidebar-normal">Expense Report</span>
                        </a>
                    </li>
                </ul>
            </div>
            </li> --}}

            <hr>
            @if (auth()->user()->can('business-setting.view') || auth()->user()->can('business-setting.create') || auth()->user()->can('payment-type.view') || auth()->user()->can('payment-type.create') || auth()->user()->can('payment-type.edit') || auth()->user()->can('payment-type.delete'))
            <li class="nav-item {{ ($activePage == 'BusinessSetting' || $activePage == 'InvoiceSetting' || $activePage == 'PaymentType' || $activePage == 'Account') ? 'active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#setting" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                    <p>Setting
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'BusinessSetting' || $activePage == 'InvoiceSetting' || $activePage == 'PaymentType' || $activePage == 'Account')  ? 'show' : '' }}" id="setting">
                    <ul class="nav">
                        @if (auth()->user()->can('business-setting.view') || auth()->user()->can('business-setting.create'))
                        <li class="nav-item{{ $activePage == 'BusinessSetting' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('Business-Setting.index')}}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Business Setting</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('payment-type.view') || auth()->user()->can('payment-type.create') || auth()->user()->can('payment-type.edit') || auth()->user()->can('payment-type.delete'))
                        <li class="nav-item{{ $activePage == 'PaymentType' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('Payment-Type.index') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Payment Type</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

        </ul>
    </div>
</div>
