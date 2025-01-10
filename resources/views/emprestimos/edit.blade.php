@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')
@include('flash')

<form method="POST" action="/emprestimos/{{$emprestimo->id}}">
@csrf
@method('PATCH')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Devolução de Empréstimo</h5>
    <div class="card-body">
        <div class="form-row">
            <div class="col">
                
                <h6 class="font-weight-bold">Título: {{ $emprestimo->instance->record->titulo }}</h6>
                <h6 class="font-weight-bold">Exemplar: {{ $emprestimo->instance->tombo }}</h6>
                </br>
                <h6 class="font-weight-bold">Nº USP do Aluno: {{ $emprestimo->n_usp }}</h6>
            </div>
        </div>
            <button class="btn btn-outline-success" type="submit" dusk="confirmar_devolucao">Confirmar Devolução de Material</button>
    </div>
</div>
</form>
@endsection('content')