{{-- IDENTIDADE VISUAL USP FFLCH --}}
@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('javascripts_head')
<script type="text/javascript" src="{{asset('js/record.js')}}"></script>
@endsection

{{-- EXIBIR DADOS CADASTRADOS --}}
@section('content')

<!-- <div class="card bg-light">
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
      </div> -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="margin-top:20px; margin-bottom:40px;">
              <div class="card-header">
                <b>Descrições do exemplar</b>
              </div>
              <div class="card-body">
              <div class="row">
                  <div class="col-3">
                    <h6>Titulo:</h6><p class="card-text">{{$record->titulo}}</p>
                    <h6>Autores: </h6><p class="card-text">{{$record->autores}}</p>
                    <h6>Ano de publicação: </h6><p class="card-text">{{$record->ano}}</p>
                  </div>
                  <div class="col-3">
                    <h6>Tipo:</h6><p class="card-text">{{$record->tipo}}</p>
                    <h6>Editora: </h6><p class="card-text">{{$record->editora ?? 'N/A'}}</p>
                    <h6>Edição: </h6><p class="card-text">{{$record->edicao ?? 'N/A'}}</p>
                  </div>
                  <div class="col-3">
                    <h6>Assunto:</h6><p class="card-text">{{$record->assunto ?? 'N/A'}}</p>
                    <h6>Idioma: </h6><p class="card-text">{{$record->idioma_completo ?? $record->idioma}}</p> 
<!-- A importação de um arquivo CSV não faz o cadastro de idioma_completo automaticamente, então, coloca-se o idioma que está no CSV  -->
                    <h6>ISBN: </h6><p class="card-text">{{$record->isbn ?? 'Não encontrado'}}</p>
                  </div>
                  <div class="col-3">
                    <h6>Local de Publicação:</h6><p class="card-text">{{$record->local_publicacao ? $record->local_publicacao : 'Não encontrado'}}</p>
<!-- Há algumas linhas do CSV que há o local_publicacao vazio. -->
                    <h6>Descrição Física: </h6><p class="card-text">{{$record->desc_fisica ?? 'N/A'}}</p>
                    <h6>ISSN: </h6><p class="card-text">{{$record->issn ?? 'Não encontrado'}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        @can('admin')
          <div class="alert alert-info" role="alert">
            <details>
              <summary>Visualizar histórico de mudanças</summary>
              <br>
              @include('records.partials.audit', ['model'=>$record])
            </details>
          </div>
        @endcan
        <br>
    </div>  
  </div>
</div>
</br>

{{-- BOTÕES CRUD E LISTAGEM INSTANCES--}}
<div class="container">
  <div class="row justify-content-around">
    <div class="col-6">
      <div class="row">
        <a class="btn btn-outline-success btn-md" href="/records" role="button">Voltar</a>
        <a class="btn btn-outline-success btn-md" href="/records/{{$record->id}}/edit" role="button">Editar</a>
        <a class="btn btn-outline-primary btn-md" href="{{ route('instances.create', $record->id) }}" role="button">Cadastrar Exemplar</a>
      </div>
    </div>

    <div class="col-6">
      <div class="list-group">
      <li class="list-group-item text-primary">Exemplares Patrimoniados:</li>
      @foreach ($record->instances as $instance) 
      <a href="{{ route('instances.show', $instance->id) }}" class="list-group-item list-group-item-action">{{ $instance->tombo }} </a>
      @endforeach
      </div>
    </div>

  </div>
</div>
<br>

<style>
  h6{ font-weight:bold; }.btn-md{ margin-right:5px; }
</style>

@endsection('content')
