@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
        <div class="col p-4 text-break"><h6 class="font-weight-bold">Título</h6>
          {{ $instance->record->titulo }}</div>
      </div>
      <div class="row">
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Tombo</h6>
          {{ $instance->tombo }}</div>
        <div class="col p-4"><h6 class="font-weight-bold">Localização:</h6> {{ $instance->localizacao }}</div>
      </div>
      @can('admin')
          <div class="alert alert-info" role="alert">
            <details>
              <summary>Visualizar histórico de mudanças</summary>
              <br>
              @include('instances.partials.audit', ['model'=>$instance])
            </details>
          </div>
        @endcan
        <br>
    </div>
 </div>
</div>
</br>
<div class="row" style="margin:5px;">
    <a class="btn btn-success btn-md" href="{{ route('records.show', $instance->record->id) }}" role="button"><i class="fas fa-arrow-left"></i> Voltar</a>
    <a class="btn btn-outline-success btn-md" href="/instances/{{$instance->id}}/edit" role="button" dusk="edit_instance"><i class="fa fa-pen"></i> Editar Exemplar</a>
    <form method="post" action="/instances/{{$instance->id}}">
      @method("delete")
      @csrf
      <button type="submit" class="btn btn-outline-danger" href="/instances/{{$instance->id}}" role="button" dusk="delete_instance" onclick="return confirm('Tem certeza que deseja deletar?');"><i class="fa fa-trash"></i> Deletar Tombo</button>
    </form>
    @if(!$instance->emprestimos->where('data_devolucao',null)->first())
    <a class="btn btn-primary btn-md" href="/emprestimos/create/{{$instance->id}}" role="button"><i class="fa fa-book"></i> Emprestar Material</a>
    @endif
</div>

<style>
  .btn{
    margin-right:5px;
  }
</style>

@endsection('content')

