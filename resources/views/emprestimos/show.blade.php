@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
        <div class="col p-4"><h6 class="font-weight-bold">Número USP do aluno:</h6>{{ $emprestimo->n_usp }}</div>        
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Data do empréstimo:</h6> {{ $emprestimo->data_emprestimo  }}</div>
      </div>
      <div class="row">
        <div class="col p-4"><h6 class="font-weight-bold">Tombo do livro:</h6>{{ $emprestimo->tombo }}</div>  
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Data da devolução:</h6> {{ $emprestimo->data_devolucao  }}</div>    
      </div>
      <div class="col"><h6 class="font-weight-bold">ID do usuário:</h6> {{ $emprestimo->user->user_id  }}</div>
    </div>
  </div>
</div>
<br>
<div class="container">
    <a class="btn btn-outline-success btn-md" href="/emprestimo" role="button">Voltar</a>
</div> 
@endsection('content')
