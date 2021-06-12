@extends('layouts.app', ['activePage' => 'product-purchase', 'titlePage' => __('Product Purchase')])

@section('content')
<div class="content pt-0" id="app">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div
						class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						"
					>
						<h4 class="card-title m-0 pt-2">Product Purchase</h4>
						{{-- <a href="{{ route('product.manage') }}" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Manage Product
						</a> --}}
					</div>

                    <product-purchase />

				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
