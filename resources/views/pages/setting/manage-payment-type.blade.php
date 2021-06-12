@extends('layouts.app', ['activePage' => 'PaymentType', 'titlePage' => __('Manage Payment Type')])

@section('content')
<div class="content pt-0" id="app">

    <payment-type />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
