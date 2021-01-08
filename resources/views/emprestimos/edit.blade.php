@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/emprestimo/{{$emprestimo->id}}">
@csrf
@method('patch')
<div class="card">
    <h5 class="card-header font-weight-bold">Devolução de Empréstimo</h5>
    <div class="card-body">
        <div class="form-row">
            <div class="col">
                <h6>Tombo do Material: {{ $emprestimo->instance->tombo }}</h6>
                </br>
                <h6>Nº USP do Aluno: {{ $emprestimo->n_usp }}</h6>
            </div>
            <div class="col">
                <label for="observacao" >Observações (opcional)</label>
                <textarea class="form-control" id="observacao" rows="2"></textarea>
            </div>
        </div>
            <button class="btn btn-outline-success" type="submit">Confirmar Devolução de Material</button>
    </div>
</div>
</form>
@endsection('content')