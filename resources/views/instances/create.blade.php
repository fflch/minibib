@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/instances">
@csrf
<div class="card">
    <h5 class="card-header font-weight-bold">Acervo</h5>
    <div class="card-body">
    @include('instances.form')
    </div>
</div>
</form>
@endsection('content')
