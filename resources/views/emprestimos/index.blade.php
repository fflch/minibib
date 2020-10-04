@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<form method="get" action="/emprestimos">
<div class="row">
    <div class=" col-sm input-group">
    <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}">
    <span class="input-group-btn">
        <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
    </span>
    </div>
</div>
</form>
</br>

{{ $emprestimos->appends(request()->query())->links() }}

<div class="card">
  <div class="card-body">
    <table class="table">
      <thead class="thead">
        <h3>Empréstimos Registrados</h3>
      </thead>
      <tbody>
      @foreach($emprestimos as $emprestimo)
        <tr>           
          <td><div class="font-weight-bold">Data do Empréstimo:</div>{{ $emprestimo->data_emprestimo}} </td>
          
        </tr>
          <td><div class="font-weight-bold">Data Devolução:</div>{{ $emprestimo->data_devolucao}} </td>          
          <td><div class="font-weight-bold">Nº USP do Aluno:</div> {{ $emprestimo->n_usp}}</td>          
          <td><div class="font-weight-bold">Código do Usuário:</div> {{ $emprestimo->user_id }}</td>            
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection('content')
