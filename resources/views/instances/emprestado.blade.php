@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

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
          <td><div class="font-weight-bold">Tombo:</div>{{ $instance->tombo }} </td>
        </tr>
          <td><div class="font-weight-bold">Data Devolução:</div>{{ $instance->emprestimo->data_devolucao }} </td>          
          <td><div class="font-weight-bold">Nº USP do Aluno:</div> {{ $instance->emprestimo->localizacao }}</td>              
        </tr>
@endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection('content')