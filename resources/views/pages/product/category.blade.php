@extends('layouts.app', ['activePage' => 'Category', 'titlePage' => __('Manage Category')])

@section('content')
<div class="content pt-0" id="app">
    <category></category>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
