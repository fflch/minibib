@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')
@include('flash')

<form method="POST" action="/instances/{{$instance->id}}">
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Edição de Registro</h5>
    <div class="card-body">
    @include('instances.form')
    </div>
</div>
</form>
@endsection('content')
