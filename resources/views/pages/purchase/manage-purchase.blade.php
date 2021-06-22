@extends('layouts.app', ['activePage' => 'manage-purchase', 'titlePage' => __('Manage Purchase')])

@section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush
<div class="content" id="app">

    <manage-purchase />

</div>
<script src="{{ asset('js/app.js') }}"></script>
@endsection

@push('js')
<script>
    $(document).ready(function() {
	    $("#example").DataTable({
            scrollX: true
        //    dom: 'Bfrtip',
        //     buttons: [
        //     'colvis',
        //     'excel',
        //     'print'
        //     ]
        });
	});
</script>
@endpush
