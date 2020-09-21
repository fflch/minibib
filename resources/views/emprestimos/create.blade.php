
@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/emprestimo">
@csrf
<div class="card">
    <h5 class="card-header font-weight-bold">Cadastro de Empréstimo</h5>
    <div class="card-body">
    @include('empresimos.form')
    </div>
</div>
</form>
@endsection('content')


