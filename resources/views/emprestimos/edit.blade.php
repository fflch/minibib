@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/emprestimo">
@csrf
@method('patch')
<div class="card">
    <h5 class="card-header font-weight-bold">Edição de Empréstimo</h5>
    <div class="card-body">
    @include('empresimos.form')
    </div>
</div>
</form>
@endsection('content')