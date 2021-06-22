@extends('layouts.app', ['activePage' => 'bank-ledger', 'titlePage' => __('Bank Ledger')])

@section('content')
<div class="content pt-0" id="app">

    <bank-ledger />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
