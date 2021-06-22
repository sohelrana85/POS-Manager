@extends('layouts.app', ['activePage' => 'product-sell', 'titlePage' => __('Product Sell')])

@section('content')
<div class="content" id="app">

    <product-sell />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
