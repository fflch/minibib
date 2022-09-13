{{-- IDENTIDADE VISUAL FFLCH --}}
@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection


{{-- FORMULÁRIO DE CADASTRO --}}
@section('content')
@include('flash')

<form method="POST" action="/records"> 
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light">Cadastro de Material</h5>
    <div class="card-body">
    @include('records.form')
    </div>
</div>
</form>
@endsection('content')