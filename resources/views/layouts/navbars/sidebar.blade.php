<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ __('POS Manager') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a style="padding: 5px 18px;" class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <hr>

            <li class="nav-item {{ ($activePage == '') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#business" aria-expanded="false">
                    <i class="fa fa-briefcase"></i>
                    <p>Business Setting
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activePage == '' ? ' show' : '' }}" id="business">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == '' ? ' active' : '' }}">
                            <a class="nav-link" href="">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Comming Soon</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

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
                            <a class="nav-link" href="{{ route('customer') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Customer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'manage-supplier' || $activePage == 'due-payment' || $activePage == 'return-item') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#supplier" aria-expanded="false">
                    <i class="fa fa-truck"></i>
                    <p>Supplier
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'manage-supplier' || $activePage == 'due-payment' || $activePage == 'return-item')  ? ' show' : '' }}" id="supplier">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'manage-supplier' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('manage.supplier') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Supplier</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'due-payment' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('due.payment') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Due Payment</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'return-item' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('return.item') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Return Items</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'add-product' || $activePage == 'manage-product') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#product" aria-expanded="false">
                    <i class="fas fa-database"></i>
                    <p>product
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'add-product' || $activePage == 'manage-product' || $activePage == 'print-barcode')  ? ' show' : '' }}" id="product">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'add-product' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('add.product') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Add Product</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'manage-product' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('product.manage') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Product</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'print-barcode' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('print.barcode') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Print Barcode</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'manage-product' || $activePage == 'manage-purchase' || $activePage == 'manage-stock' || $activePage == 'product-purchase') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#purchase" aria-expanded="false">
                    <i class="fa fa-cart-plus"></i>
                    <p>Purchase
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'manage-purchase' || $activePage == 'product-purchase')  ? ' show' : '' }}" id="purchase">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'product-purchase' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('product.purchase') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Product Purchase</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'manage-purchase' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('manage.purchase') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Purchase</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'manage-stock') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#stock" aria-expanded="false">
                    <i class="fa fa-palette"></i>
                    <p>Stock
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'add-stock' || $activePage == 'manage-stock')  ? ' show' : '' }}" id="stock">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'add-stock' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('add.stock') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Add Stock</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'manage-stock' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('manage.stock') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Stock</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item {{ ($activePage == 'sell-product') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#sell" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Sell
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'sell-product')  ? ' show' : '' }}" id="sell">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('sell.product') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Sell Product</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'sell-product') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#expense" aria-expanded="false">
                    <i class="fas fa-dollar-sign"></i>
                    <p>Expense
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'sell-product')  ? ' show' : '' }}" id="expense">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                            <a class="nav-link" href="">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Add Expense</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'sell-product' ? ' active' : '' }}">
                            <a class="nav-link" href="">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Manage Expense</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'bank-account') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#bank" aria-expanded="false">
                    <i class="fas fa-university"></i>
                    <p>Bank
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'bank-account')  ? ' show' : '' }}" id="bank">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'bank-account' ? ' active' : '' }}">
                            <a class="nav-link" href="">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Bank Account</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'sell-product') ? ' active' : '' }}">
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
            </li>

            <hr>

            <li class="nav-item {{ ($activePage == 'unitType' || $activePage == 'PackageSize' || $activePage == 'PaymentType' || $activePage == 'Category' || $activePage == 'Brand') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#setting" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                    <p>Setting
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'unitType' || $activePage == 'PackageSize' || $activePage == 'PaymentType' || $activePage == 'Category' || $activePage == 'Brand')  ? ' show' : '' }}" id="setting">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'unitType' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('unit.type') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Unit Type</span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'PackageSize' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('package.size') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Package Size</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'PaymentType' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('payment.type') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Payment Type</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'Category' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('category') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Category</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'Brand' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('brand') }}">
                                <i class="fas fa-minus"></i>
                                <span class="sidebar-normal">Brand</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('table') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Table List') }}</p>
            </a>
            </li> --}}

        </ul>
    </div>
</div>
