@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/records"> 
@csrf
<div class="card">
    <h5 class="card-header">Cadastro de Material</h5>
    <div class="card-body">
    @include('records.form')
    </div>
</div>
</form>
@endsection('content')