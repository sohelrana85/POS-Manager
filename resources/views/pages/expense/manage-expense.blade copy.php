@extends('layouts.app', ['activePage' => 'manage-expense', 'titlePage' => __('Manage Expense')])


@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="content pt-0" id="app">
    <manage-expense />
</div>

<script src="{{ asset('js/app.js') }}"></script>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
@endpush
