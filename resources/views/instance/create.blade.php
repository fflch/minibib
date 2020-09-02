@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/instance">
@csrf
<div class="card">
    <h5 class="card-header font-weight-bold">Acervo</h5>
    <div class="card-body">
    @include('instance.form')
    </div>
</div>
</form>
@endsection('content')
