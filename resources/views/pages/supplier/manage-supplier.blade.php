@extends('layouts.app', ['activePage' => 'manage-supplier', 'titlePage' => __('Manage Supplier')])

@section('content')
<div class="content" id="app">
    <manage-supplier></manage-supplier>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
