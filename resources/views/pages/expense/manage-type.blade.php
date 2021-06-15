@extends('layouts.app', ['activePage' => 'manage-type', 'titlePage' => __('Manage Type')])

@section('content')
<div class="content pt-0" id="app">
    <manage-type />
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
