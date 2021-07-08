@extends('layouts.app', ['activePage' => 'expense-type', 'titlePage' => __('Expense Type')])

@section('content')
<div class="content" id="app">
    <expense-type />
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
