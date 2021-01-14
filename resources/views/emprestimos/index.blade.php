@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

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
            <a class="btn btn-outline-success btn-sm" href="/emprestimos/{{$emprestimo->id}}/edit">Devolver</i></a>
          </form>
        </td>
      </tr>
      <tr>
        <td class="border-top-0 ">
          Emprestado para: {{ $emprestimo->n_usp }}  - {{ $emprestimo->nome }}<br>
        </td>
        <td class="border-top-0 ">
          Data do Empréstimo: {{ $emprestimo->data_emprestimo }}
          ({{ \Carbon\Carbon::createFromFormat('d/m/Y', $emprestimo->data_emprestimo)->diffInDays(Carbon\Carbon::now()) }} dias)
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>



@endsection('content')
