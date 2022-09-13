@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')
@include('flash')

<form method="POST" action="/records/{{$record->id}}"> 
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light" dusk="edit_page">Edição de Cadastro</h5>
    <div class="card-body">
    @include('records.form')
    </div>
</div>
</form>
@endsection('content')