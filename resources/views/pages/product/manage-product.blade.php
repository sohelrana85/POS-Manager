@extends('layouts.app', ['activePage' => 'manage-product', 'titlePage' => __('Manage Product')])

@section('content')
<div class="content" id="app">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary	d-flex justify-content-between py-1">
                        <h4 class="card-title m-0 pt-2">Manage Product</h4>
                        @can('product.create')
                        <a href="{{ route('Product.create') }}" class="btn btn-info px-3">
                            <i class="fa fa-plus pr-1 font-weight-lighter"></i>
                            Add Product
                        </a>
                        @endcan
                        <!-- <p class="card-category">Manage customer page</p> -->
                    </div>

                    <manage-product />
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
