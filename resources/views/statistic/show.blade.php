@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
        <div class="col p-auto bg-light text-uppercase font-weight-bold text-info">Soma de Exemplares Cadastrados:</div>
        <div class="col p-auto bg-light text-uppercase font-weight-bold text-info">Soma de Materiais Cadastrados:</div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="container bg-light">
      <div class="row">
        <div class="col"><h6 class="font-weight-bold">{{ $instance }}</h6></div> 
        <div class="col"><h6 class="font-weight-bold">{{ $record }}</h6></div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <form method="get" action="/statistics/excel/material">
          <button type="submit" class="btn btn-success"><i class="fas fa-file-export"></i> Exportar Materiais</button>
        </form>
      </div>
        <div class="col-12" style="margin-top:5px; margin-bottom:5px;">
        <form method="get" action="/statistics/excel/exemplares">
          <button type="submit" class="btn btn-success"><i class="fas fa-book"></i> Exportar Exemplares</button>
        </form>
        </div>
      <div class="col-12">
        <form method="get" action="/statistics/excel/materiais_completos">
          <button type="submit" class="btn btn-success"><i class="fas fa-book"></i> <i class="fas fa-file-export"></i> Exportar Materiais com Exemplares</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection('content')