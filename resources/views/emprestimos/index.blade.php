@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')

<form method="get" action="/emprestimos">
<div class="row">
    <div class=" col-sm input-group">
    <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Pesquisa por número USP">
    <span class="input-group-btn">
        <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
    </span>
    </div>
</div> <br>

{{ $emprestimos->appends(request()->query())->links() }}
</form>
</br>
<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <h3>Emprestados</h3>
  </div>
  <table class="table">
    <tbody>
    @foreach($emprestimos as $emprestimo)
      <tr>
        <th>
          Material: <a href="/records/{{ $emprestimo->instance->record->id }}">{{ $emprestimo->instance->record->titulo }} </a> <br>
          Exemplar: {{ $emprestimo->instance->tombo }} <br>
          Localização: {{ $emprestimo->instance->localizacao }}
        </th>
        <td>
          <form class="row-sm" method="POST" action="/emprestimos/{{$emprestimo->id}}">
            @csrf
            <a class="btn btn-outline-success btn-sm" href="/emprestimos/{{$emprestimo->id}}/edit">Devolver</a>
          </form>
        </td>
      </tr>
      <tr>
        <td class="border-top-0 ">
          Emprestado para: {{ $emprestimo->n_usp }}  - {{ $emprestimo->nome }}<br>
        </td>
        <td class="border-top-0 ">

          Data do Empréstimo: {{ $emprestimo->data_emprestimo }}
          (há {{ (int)\Carbon\Carbon::createFromFormat('d/m/Y', $emprestimo->data_emprestimo)->diffInDays(\Carbon\Carbon::now()) }} dias )
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<br />
{{ $emprestimos->appends(request()->query())->links() }}

@endsection('content')
