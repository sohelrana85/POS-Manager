@extends('layouts.app', ['activePage' => 'add-product', 'titlePage' => __('Add Product')])

@section('content')
<div class="content" id="app">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						">
                        <h4 class="card-title m-0 pt-2">Add Product</h4>
                        @if(auth()->user()->can('product.view') || auth()->user()->can('product.edit') || auth()->user()->can('product.delete'))
                        <a href="{{ route('Product.index') }}" class="btn btn-info px-3">
                            <i class="fa fa-plus pr-1 font-weight-lighter"></i>
                            Manage Product
                        </a>
                        @endif
                    </div>

                    <add-product />

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
