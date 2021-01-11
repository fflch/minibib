
@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/emprestimos">
@csrf
<div class="card">
    <h5 class="card-header font-weight-bold">Novo Empréstimo</h5>
    <div class="card-body">
    @include('emprestimos.form')
    </div>
</div>
</form>
@endsection('content')


