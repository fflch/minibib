@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/users/{{$usuario->id}}"> 
@csrf
@method('patch')
<div class="card">
    <h5 class="card-header font-weight-bold">Edição de Usuário</h5>
    <div class="card-body">
    @include('users.form')
    </div>
</div>
</form>
@endsection('content')