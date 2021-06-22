@extends('layouts.app', ['activePage' => 'add-stock', 'titlePage' => __('Add Stock')])

@section('content')
@push('css')
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush
<div class="content" id="app">

    <add-stock />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
