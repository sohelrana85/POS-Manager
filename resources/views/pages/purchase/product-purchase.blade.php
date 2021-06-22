@extends('layouts.app', ['activePage' => 'product-purchase', 'titlePage' => __('Product Purchase')])

@section('content')
<div class="content" id="app">

    <product-purchase />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
