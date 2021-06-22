@extends('layouts.app', ['activePage' => 'manage-bank', 'titlePage' => __('Manage Bank')])

@section('content')
<div class="content" id="app">

    <manage-bank />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
