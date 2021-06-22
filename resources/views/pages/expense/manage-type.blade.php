@extends('layouts.app', ['activePage' => 'manage-type', 'titlePage' => __('Manage Type')])

@section('content')
<div class="content" id="app">
    <manage-type />
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
