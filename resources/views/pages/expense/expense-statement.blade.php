@extends('layouts.app', ['activePage' => 'expense-statement', 'titlePage' => __('Expense Statement')])

@section('content')
<div class="content" id="app">

    <expense-statement />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
