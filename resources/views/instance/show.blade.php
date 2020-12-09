@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

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
    </div>
 </div>
</div>
</br>
<form class="row-sm" method="POST" action="/instance/{{$instance->id}}">
  <a class="btn btn-success btn-md" href="{{ route('records.show', $instance->record->id) }}" role="button">Voltar</a>
  <a class="btn btn-outline-success btn-md" href="/instance/{{$instance->id}}/edit" role="button">Editar Tombo</a>
  <a class="btn btn-primary btn-md" href="/emprestimo/create/{{$instance->id}}" role="button">Emprestar Material</a>
  @csrf
</form>

@endsection('content')

