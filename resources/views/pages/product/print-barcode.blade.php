@extends('layouts.app', ['activePage' => 'print-barcode', 'titlePage' => __('Print Barcode')])

@section('content')
<div class="content pt-0" id="app">
    <barcode />
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
