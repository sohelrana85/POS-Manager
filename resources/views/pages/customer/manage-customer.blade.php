@extends('layouts.app', ['activePage' => 'customer', 'titlePage' => __('Manage Customer')])

@section('content')
<div class="content" id="app">
    <customer></customer>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
