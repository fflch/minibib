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
    <table class="table bg-light">
      <thead class="thead">
        <h3 >Empréstimos Registrados</h3>
      </thead>
      <tbody>
      @foreach($emprestimos as $emprestimo)
        <tr>
          <th>Tombo do Empréstimo: {{ $emprestimo->instance->tombo }} </th>
          <td>
            <form class="row-sm" method="POST" action="/emprestimo/{{$emprestimo->id}}">
            @if (empty($emprestimo->data_devolucao))
            <a class="btn btn-outline-success btn-sm" href="/emprestimo/{{$emprestimo->id}}/edit">Devolver</i></a>
            @endif
              <a class="btn btn-outline-success btn-sm" href="/emprestimo/{{$emprestimo->id}}">Ver</i></a>
              @csrf
            </form>
          </td>
        </tr>
        <tr>
          <td class="border-top-0 ">Nº USP do Aluno: {{ $emprestimo->n_usp}}</td>
          @if (empty($emprestimo->data_devolucao))
          <td class="border-top-0 font-weight-bolder text-danger">Empréstimo Ativo</td>
          @else
          <td class="border-top-0 ">Data Devolução: {{ $emprestimo->data_devolucao }}</td>
          @endif
          <td class="border-top-0 ">Data do Empréstimo: {{ $emprestimo->data_emprestimo}}</td>
          <td class="border-top-0 ">Código do Usuário: {{ $emprestimo->user_id }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection('content')
