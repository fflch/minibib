@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
        <div class="col p-auto bg-light text-uppercase font-weight-bold text-info">Soma de Itens Cadastrados:</div>
        <div class="col p-auto bg-light text-uppercase font-weight-bold text-info">Soma de Materiais Cadastrados:</div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="container bg-light">
      <div class="row">
        <div class="col "><h6 class="font-weight-bold">{{ $instance }}</h6></div>        
        <div class="col "><h6 class="font-weight-bold">{{ $record }}</h6></div>
      </div>
    </div>
  </div>
</div>
@endsection('content')