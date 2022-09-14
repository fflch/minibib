@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')
@include('flash')

<form method="POST" action="/users"> 
@csrf
<div class="card">
    <h5 class="card-header font-weight-bold">Cadastro de Usuário</h5>
    <div class="card-body">
    @include('users.form')
    </div>
</div>
</form>
@endsection('content')