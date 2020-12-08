@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<div class="card">
  <div class="card-body">
    <table class="table">
      <thead class="thead">
        <h3>Empréstimos Ativos</h3>
      </thead>
      <tbody>
@foreach($emprestimo as $emprestimo)
        <tr>           
          <td><div class="font-weight-bold">Tombo:</div>{{ $emprestimo->tombo }} </td>
        </tr>
          <td><div class="font-weight-bold">Data Devolução:</div>{{ $emprestimo->data_devolucao }} </td>          
          <td><div class="font-weight-bold">Nº USP do Aluno:</div> {{ $emprestimo->localizacao }}</td>              
        </tr>
@endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection('content')