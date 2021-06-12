@extends('layouts.app', ['activePage' => 'print-barcode', 'titlePage' => __('Print Barcode')])

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
							<h4 class="card-title m-0 pt-2">Print Barcode</h4>
							<a href="" class="btn btn-info px-3">
								<i class="fa fa-plus pr-1 font-weight-lighter"></i>
								List Barcode
							</a>
							<!-- <p class="card-category">Manage customer page</p> -->
						</div>

                        {{-- <manage-product /> --}}
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
