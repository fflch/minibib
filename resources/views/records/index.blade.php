@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('javascripts_head')
<script type="text/javascript" src="{{asset('js/record.js')}}"></script>
@endsection

@section('content')

<form method="get" action="/records">
<div class="row">
    <div class=" col-sm input-group">
    <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}">
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
      <thead class="thead ">
        @foreach($records as $record)
        <tr class="table alert alert-dark">
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
            <a class="btn btn-outline-primary btn-sm" href="{{ route('instance.create',
            $record->id) }}">Cadastrar Tombo</br><i class="fas fa-barcode"></i></a>
          </form>
          </div>
        </td>
      @endcan('admin')
        </td>
      </tr>
      <tr>          
        <td><div class="font-weight-bold">Idioma:</div> {{ \App\Utils\Idioma::lista()[$record->idioma] ?? 'Sem Idioma Cadastrado'}} </td>
        <td><div class="font-weight-bold">Ano de Publicação:</div> {{ $record->ano }}</td>
      </tr>
      <tr>
        <td><div class="font-weight-bold">Categoria:</div>{{ $record->tipo }}</td>
        <td>ISBN:<div class="isbn">{{ $record->isbn }}</div></td>
      </tr>
      <tr>
        <td>
        <div class="font-weight-bold">Tombos Patrimoniados:</div>
          <ul class="list-inline">
            @foreach ($record->instances as $instance) 
              @can('admin')
                <a class="list-inline-item" href="{{ route('instance.show', $instance->id) }}">{{ $instance->tombo }} </a>
              @else
                {{ $instance->tombo }}
              @endcan('admin')
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
