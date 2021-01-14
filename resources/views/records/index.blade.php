@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('javascripts_head')
<script type="text/javascript" src="{{asset('js/record.js')}}"></script>
@endsection

@section('content')

<form method="get" action="/records">
<div class="row">
    <div class=" col-sm input-group">
    <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Pesquisa por título, autor e tombo..">
    <span class="input-group-btn">
        <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
    </span>
    </div>
</div>
</form>
</br>

{{ $records->appends(request()->query())->links() }}

<div class="container-fluid">
  <div class="table-responsive-sm">
    <table class="table text-justify bg-light">
      <thead class="thead border-info">
        @foreach($records as $record)
        <tr class="table alert alert-secondary border-info">
          <th scope="col" ><div class="text-uppercase">{{$record->titulo }}</div></th>
          <th scope="col" ><div style="width: 18rem;" class="text-center font-weight-bold">@can('admin')Ações:@endcan('admin')</div></th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><div class="font-weight-bold">Autores:</div>{{$record->autores }}</td>
        @can('admin')
        <td><div class="text-center">

          <form class="row-sm" method="POST" action="/records/{{$record->id}}">
          <a class="btn btn-outline-success btn-lg" data-toggle="tooltip" title="Editar" href="/records/{{$record->id}}/edit"><i class="far fa-edit"></i></a>
          <a class="btn btn-outline-success btn-lg" data-toggle="tooltip" title="Ver" href="/records/{{$record->id}}"><i class="fas fa-external-link-alt"></i></a>
            @csrf
            <a class="btn btn-outline-primary btn-sm" href="{{ route('instances.create',
            $record->id) }}">Cadastrar Tombo</br><i class="fas fa-barcode"></i></a>
          </form>
          </div>
        </td>
      @endcan('admin')
        </td>
      </tr>
      <tr>          
        <td><div class="font-weight-bold">Idioma:</div> {{ $record->idioma }} </td>
        <td><div class="font-weight-bold">Ano de Publicação:</div> {{ $record->ano }}</td>
      </tr>
      <tr>
        <td><div class="font-weight-bold">Categoria:</div>{{ $record->tipo }}</td>
        <td>ISBN:<div class="isbn">{{ $record->isbn }}</div></td>
      </tr>
      <tr>
        <td>
        <div class="font-weight-bold">Exemplares:</div>
          <ul class="list-inline">
            @foreach ($record->instances as $instance) 
              <li>
                <i class="fas fa-map-marker-alt"></i> {{ $instance->localizacao }}
                <i class="fas fa-tags"></i> {{ $instance->tombo }}
                
                <i class="fas fa-book"></i>
                @if($instance->emprestimos->where('data_devolucao',null)->first())
                  <span style="color: red">Indisponível</span>
                @else
                  Disponínel
                @endif

                  @can('admin')
                    <i class="far fa-edit"></i>
                    </i> <a class="list-inline-item" href="{{ route('instances.show', $instance->id) }}">Editar</a>

                    @if(!$instance->emprestimos->where('data_devolucao',null)->first())
                      <i class="fas fa-book"></i>
                      <a href="/emprestimos/create/{{$instance->id}}" role="button">Emprestar</a>
                    @endif
                    
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
 


@endsection('content')
