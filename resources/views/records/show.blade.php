{{-- IDENTIDADE VISUAL USP FFLCH --}}
@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('javascripts_head')
<script type="text/javascript" src="{{asset('js/record.js')}}"></script>
@endsection

{{-- EXIBIR DADOS CADASTRADOS --}}
@section('content')
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
                    <h6>ISBN: </h6><p class="card-text">{{$record->isbn ?? 'Não encontrado'}}</p>
                  </div>
                  <div class="col-3">
                    <h6>Local de Publicação:</h6><p class="card-text">{{$record->local_publicacao ? $record->local_publicacao : 'Não encontrado'}}</p>
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
        <a class="btn btn-outline-primary btn-md" href="{{ route('instances.create', $record->id) }}" role="button" dusk="cadastrar_exemplar">Cadastrar Exemplar</a>
      </div>
    </div>

    <div class="col-6">
      <div class="list-group">
      <li class="list-group-item text-primary">Exemplares Patrimoniados:</li>
      @foreach ($record->instances as $instance)
      <a href="{{ route('instances.show', $instance->id) }}" class="list-group-item list-group-item-action" dusk="instance">{{ $instance->tombo }} </a>
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
