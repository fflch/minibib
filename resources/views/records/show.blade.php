{{-- IDENTIDADE VISUAL USP FFLCH --}}
@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('javascripts_head')
<script type="text/javascript" src="{{asset('js/record.js')}}"></script>
@endsection

{{-- EXIBIR DADOS CADASTRADOS --}}
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
        <div class="col p-auto"><h6 class="font-weight-bold">Idioma:</h6> {{ $record->idioma_completo }}</div>
        <div class="col p-4 col-xl-3 "><h6 class="font-weight-bold">ISBN:</h6><div class="isbn">{{ $record->isbn}}</div></div>
      </div>
      <div class="row">
        <div class="col p-4 col-xl-3"><h6 class="font-weight-bold">Local de publicação:</h6>{{ $record->local_publicacao}}</div>
        <div class="col p-4 col-xl-3 "><h6 class="font-weight-bold">ISSN:</h6><div class="issn">{{ $record->issn}}</div></div>
      </div>
    </div>
    <div class="container bg-light">
      <div class="row">
        <div class="text-break p-xl-4 bg-light text-justify"><h6 class="font-weight-bold">Descrição Física:</h6>{{ $record->desc_fisica }}</div>
      </div>
    </div>  
  </div>
</div>
</br>

{{-- BOTÕES CRUD E LISTAGEM INSTANCES--}}
<div class="container">
  <div class="row justify-content-around">
    <div class="col-4">
      <a class="btn btn-outline-success btn-md" href="/records" role="button">Voltar</a>
      <a class="btn btn-outline-success btn-md" href="/records/{{$record->id}}/edit" role="button">Editar</a>
      <a class="btn btn-outline-primary btn-md" href="{{ route('instances.create', $record->id) }}" role="button">Cadastrar Tombo</a>
    </div>


    <div class="col-4">
      <div class="list-group">
      <li class="list-group-item text-primary">Tombos Patrimoniados:</li>
      @foreach ($record->instances as $instance) 
      <a href="{{ route('instances.show', $instance->id) }}" class="list-group-item list-group-item-action">{{ $instance->tombo }} </a>
      @endforeach
      </div>
    </div>

  </div>
</div>
<br>

@endsection('content')
