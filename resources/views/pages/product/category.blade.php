@extends('layouts.app', ['activePage' => 'Category', 'titlePage' => __('Manage Category')])

@section('content')
<div class="content" id="app">
    <category></category>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
