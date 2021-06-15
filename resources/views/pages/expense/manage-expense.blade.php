@extends('layouts.app', ['activePage' => 'manage-expense', 'titlePage' => __('Manage Expense')])

@section('content')
<div class="content pt-0" id="app">
    <manage-expense />
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
