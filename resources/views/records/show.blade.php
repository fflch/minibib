@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')


<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <div class="row">
        <div class="col p-auto"><h4 class="bg-light text-break text-uppercase font-weight-bold text-info">{{ $record->titulo }}</h4></div>
        <div class="col p-auto"><h6 class="font-weight-bold">Categoria:</h6><div class="bg-light text-uppercase">{{ $record->tipo }}</div></div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="container bg-light">
      <div class="row">
        <div class="col p-4 text-break"><h6 class="font-weight-bold">Autores:</h6>{{ $record->autores }}</div>        
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Ano:</h6> {{ $record->ano }}</div>
      </div>
      <div class="row">
        <div class="col p-4 text-break"><h6 class="font-weight-bold">Editora:</h6> {{ $record->editora }}</div>
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Edição:</h6>{{ $record->edicao }}</div>        
      </div>
    </div>
    <div class="container bg-light">
      <div class="row">
        <div class="col p-4 text-break"><h6 class="font-weight-bold">Assunto:</h6>{{ $record->assunto }}</div>
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Idioma:</h6> {{ $record->idioma }}</div>
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">ISBN:</h6> {{ $record->isbn }}</div>
      </div>
      <div class="row">
        <div class="col p-4 text-break"><h6 class="font-weight-bold">Localização:</h6> {{ $record->localizacao }}</div>
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Local de publicação:</h6>{{ $record->local_p}}</div>
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">ISSN:</h6>{{ $record->issn}}</div>
      </div>
    </div>
    <div class="container bg-light">
      <div class="row">
        <div class="text-break p-xl-4 bg-light text-justify"><h6 class="font-weight-bold">Descrição Física:</h6>{{ $record->desc_f }}</div>
      </div>
    </div>  
  </div>
</div>
</br>
<a class="btn btn-outline-success btn-md" href="/records" role="button">Voltar</a>
<a class="btn btn-outline-success btn-md" href="/records/{{$record->id}}/edit" role="button">Editar</a>
<a class="btn btn-outline-primary btn-md" href="{{ route('instance.create', $record->id) }}" role="button">Cadastrar Tombo</a>

  
@endsection('content')
