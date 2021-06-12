@extends('layouts.app', ['activePage' => 'manage-supplier', 'titlePage' => __('Manage Supplier')])

@section('content')
<div class="content pt-0" id="app">
    <manage-supplier></manage-supplier>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
