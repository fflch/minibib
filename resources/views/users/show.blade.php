@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
        <div class="col p-auto bg-light text-uppercase font-weight-bold text-info">{{ $usuario->name }}</div>
        <div class="col p-auto bg-light"><h6 class="font-weight-bold">Status:</h6>{{ $usuario->status }}</div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="container bg-light">
      <div class="row">
        <div class="col "><h6 class="font-weight-bold">Nº USP:</h6>{{ $usuario->codpes }}</div>        
        <div class="col "><h6 class="font-weight-bold">E-mail USP:</h6>{{ $usuario->email }}</div>
      </div>
    </div>
  </div>
</div>
@endsection('content')