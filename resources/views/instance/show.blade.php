@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
<<<<<<< HEAD
        <div class="col p-4 text-break" ><h6 class="font-weight-bold">Título</h6>
          {{ $record->titulo }} </div>
=======
        <div class="col p-4 text-break"><h6 class="font-weight-bold">Título</h6>
          {{ $instance->record->titulo }}</div>
>>>>>>> upstream/master
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Tombo</h6>
          {{ $instance->tombo }}</div>
      </div>
    </div>
 </div>
</div>
</br>
<a class="btn btn-success btn-md" href="/instance" role="button">Voltar</a>
<a class="btn btn-outline-success btn-md" href="/instance/{{$instance->id}}/edit" role="button">Editar</a>

@endsection('content')

