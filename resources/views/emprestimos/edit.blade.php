@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/emprestimos/{{$emprestimo->id}}">
@csrf
@method('patch')
<div class="card">
    <h5 class="card-header font-weight-bold">Devolução de Empréstimo</h5>
    <div class="card-body">
        <div class="form-row">
            <div class="col">
                
                <h6>Título: {{ $emprestimo->instance->record->titulo }}</h6>
                <h6>Exemplar: {{ $emprestimo->instance->tombo }}</h6>
                </br>
                <h6>Nº USP do Aluno: {{ $emprestimo->n_usp }}</h6>
            </div>
        </div>
            <button class="btn btn-outline-success" type="submit">Confirmar Devolução de Material</button>
    </div>
</div>
</form>
@endsection('content')