@extends('layouts.app', ['activePage' => 'PackageSize', 'titlePage' => __('Manage Package Size')])

@section('content')
<div class="content" id="app">
    <package-size></package-size>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
