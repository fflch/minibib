@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/instances/{{$instance->id}}">
@csrf
@method('patch')
<div class="card">
    <h5 class="card-header font-weight-bold">Edição de Registro</h5>
    <div class="card-body">
    @include('instances.form')
    </div>
</div>
</form>
@endsection('content')
