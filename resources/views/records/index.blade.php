@extends('laravel-usp-theme::master')

@section('title') {{ config('app.name') }} @endsection

@section('javascripts_head')
<script type="text/javascript" src="{{asset('js/record.js')}}"></script>
@endsection

@section('content')

@include('flash')

<form method="get" action="/records">
  <div class="row">
    <div class=" col-sm input-group">
      <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Pesquisa por título, autor e tombo..">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-success" style="padding:10px; margin-left:6px;"><i class="fas fa-search"></i></button>
      </span>
    </div>
  </div>
</form>


{{ $records->appends(request()->query())->links() }}
<div class="container-fluid">
  <div class="table-responsive-sm">
    <table class="table text-justify bg-light">
      <thead class="thead border-info">
        <b>Número de registros:</b> {{$recordsCount}}
        @foreach($records as $record)
          <tr class="table alert alert-secondary border-info">
            <th scope="col" ><div class="text-uppercase">{{$record->titulo }}</div></th>
            <th scope="col" ><div style="width: 18rem;" class="text-center font-weight-bold">@can('admin')Ações:@endcan('admin')</div></th>
          </tr>
        </thead>
      <tbody>
      <tr>
        <td>
          <div class="font-weight-bold">Autores:</div>{{$record->autores }}
        </td>
        @can('admin')
        <td>
          <div class="row" style="margin-bottom:10px;">
            <div class="col-md-6">
              <a href="{{ route('instances.create', $record->id) }}" id="x" class="btn btn-outline-primary">Cadastrar Exemplar <br /><i class="fa fa-barcode"></i></a>
            </div>
            <div class="col-md-6">
              <a href="/records/{{$record->id}}" class="btn btn-outline-primary" style="width:7rem;">Visualizar Material <br /><i class="fa fa-eye"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <a href="/records/{{$record->id}}/edit" class="btn btn-outline-success" style="width:8.4rem;">Editar <br /><i class="fa fa-edit"></i></a>
            </div>
            <div class="col-md-6">
              <form method="post" action="/records/{{$record->id}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Tem certeza que deseja excluir este arquivo?');" class="btn btn-outline-danger" style="width:7rem;">Excluir <br/><i class="fa fa-trash"></i></button>
              </form>
            </div>
          </div>
        </td>
      @endcan('admin')
        </td>
      </tr>
      <tr>
        <td><div class="font-weight-bold">Idioma:</div> {{ $record->idioma_completo ?? $record->idioma }} </td>
        <td><div class="font-weight-bold">Ano de Publicação:</div> {{ $record->ano }}</td>
      </tr>
      <tr>
        <td><div class="font-weight-bold">Categoria:</div>{{ $record->tipo }}</td>
        <td><div class="font-weight-bold">ISBN: <br></div>{{ $record->isbn ?? 'Não encontrado' }}</td>
      </tr>
      <tr>
        <td>
        <div class="font-weight-bold">Exemplares:</div>
          <ul class="list-inline">
            @forelse($record->instances as $in)
                <p>{{$in->tombo}}</p>
            @empty
                <p class="text-danger">Não há exemplares cadastrados</p>
            @endforelse
            @foreach($record->instances as $instance)
              <li>
                <i class="fas fa-map-marker-alt"></i> {{ $instance->localizacao ? $instance->localizacao : 'Não encontrado'}}
                <i class="fas fa-tags"></i> {{ $instance->tombo }}
                <i class="fas fa-book"></i>
                  @if($instance->emprestimos->where('data_devolucao',null)->first())
                    <span style="color: red">Indisponível</span>
                    @else
                    <span class="text-success">Disponível</span>
                  @endif
                  @can('admin')
                  
                      @if(!$instance->emprestimos->where('data_devolucao',null)->first())
                      <i class="fas fa-book"></i>
                      <a href="/emprestimos/create/{{$instance->id}}" role="button">Emprestar</a>
                      @endif
                      <form method="POST" action="/instances/{{$instance->id}}">
                        <i class="fa fa-trash"></i>
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" onclick="return confirm('Tem certeza que deseja deletar?');" dusk="delete_instance"> Deletar exemplar  </button>
                      </form>
                      <hr>
                  @endcan('admin')
                </li>
                @endforeach
              </ul>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
{{ $records->appends(request()->query())->links() }}

@endsection('content')
<style>
    @media(max-width:1366px){
      #x{
        padding:.50rem;
      }
    }
    @media(max-width:1280px){
      #x{
        padding:.35rem;
        font-size:18px;
        width:100%;
      }
    }
</style>