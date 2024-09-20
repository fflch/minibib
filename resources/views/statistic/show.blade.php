@extends('laravel-usp-theme::master')

@section('title') Biblioteca Teiiti Suzuki @endsection

@section('content')

@include('flash')

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
        <form method="get" action="/statistics/excel/materiais">
          <a href="statistics/excel/materiais?busca={{request()->busca}}" type="submit" class="btn btn-success"><i class="fas fa-file-export"></i> Exportar Materiais</a>
        </form>
      </div>
        <div class="col-12" style="margin-top:5px; margin-bottom:5px;">
        <form method="get" action="/statistics/excel/exemplares">
          <a href="statistics/excel/exemplares?busca={{request()->busca}}" type="submit" class="btn btn-success"><i class="fas fa-book"></i> Exportar Exemplares</a>
        </form>
        </div>
      <div class="col-12">
        <form method="get" action="/statistics/excel/materiais_completos">
          <a href="statistics/excel/materiais_completos?busca={{request()->busca}}" type="submit" class="btn btn-success"><i class="fas fa-book"></i> <i class="fas fa-file-export"></i> Exportar Materiais com Exemplares</a>
        </form>
        <br />
        <form method="get" action="/statistics">
            <div class="row" style="padding:15px;">
              <input type="text" class="form-control" placeholder="Pesquisar por título ou isbn" style="max-width:30%; margin-right:5px;" name="busca" value="{{Request()->busca}}">
              <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </div>
          </form>
        {{ $materiais->appends(request()->query())->links() }}
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Título</th>
              <th scope="col">Autor(es)</th>
              <th scope="col">ISBN</th>
              <th scope="col">Tombo</th>
              <th scope="col">Localização</th>
            </tr>
          </thead>
          <tbody>
            @forelse($materiais as $material)
            <tr>
              <td>{{$material->titulo}}</td>
              <td>{{$material->autores}}</td>
              <td>{{$material->isbn ?? 'N/A'}}</td>
              <td>{{$material->tombo}}</td>
              <td>{{$material->localizacao}}</td>
            </tr>
            @empty
            <p class="text-danger">Não foram encontrados materiais</p>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection('content')
