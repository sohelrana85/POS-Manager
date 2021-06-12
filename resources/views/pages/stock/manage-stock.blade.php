@extends('layouts.app', ['activePage' => 'manage-stock', 'titlePage' => __('Manage Stock')])

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
						<h4 class="card-title m-0 pt-2">Manage Stock</h4>
					</div>

                    <manage-stock />
                </div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@push('js')
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<script src="{{asset('material')}}/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "scrollX": true
        } );
    } );
</script>
@endpush
@endsection
