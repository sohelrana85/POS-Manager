@extends('layouts.app', ['activePage' => 'customer', 'titlePage' => __('Manage Customer')])

@section('content')
<div class="content pt-0" id="app">
    <customer></customer>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
