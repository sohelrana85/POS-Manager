@extends('layouts.app', ['activePage' => 'bank-transaction', 'titlePage' => __('Bank Transaction')])

@section('content')
<div class="content" id="app">

    <bank-transaction />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
