@extends('layouts.app', ['activePage' => 'Brand', 'titlePage' => __('Manage Brand')])

@section('content')
<div class="content pt-0" id="app">
    <brand></brand>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
