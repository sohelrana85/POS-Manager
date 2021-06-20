@extends('layouts.app', ['activePage' => 'BusinessSetting', 'titlePage' => __('Business Setting')])

@section('content')
<div class="content pt-0" id="app">

    <business-setting />

</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
