@extends('layouts.app', ['activePage' => 'due-payment', 'titlePage' => __('Due Payment')])

@section('content')
<div class="content pt-0" id="app">
    <div class="text-center pt-5">
        <img src="{{ asset('material/img/under-construction.jpg') }}" style="width:600px">
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
