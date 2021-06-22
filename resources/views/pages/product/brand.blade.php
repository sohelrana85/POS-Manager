@extends('layouts.app', ['activePage' => 'Brand', 'titlePage' => __('Manage Brand')])

@section('content')
<div class="content" id="app">
    <brand></brand>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
