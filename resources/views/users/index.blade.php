@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<form method="get" action="/users">
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

{{ $usuarios->appends(request()->query())->links() }}

<div class="card">
  <div class="card-body">
    <table class="table">
      <thead class="thead">
        @foreach($usuarios as $usuario)
        <tr class="table bg-light"> 
          <th scope="col"><div class="text-uppercase">{{ $usuario->name }}</div></th>
          <th scope="col" ><div class="text-center font-weight-bold">Ações:</div></th> 
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><div class="font-weight-bold">E-mail:</div>{{ $usuario->email }}</td>       
        <td><div class="text-center">
          <a class="row-sm btn-lg" href="/users/{{$usuario->id}}/edit"><i class="far fa-edit"></i></a>
          <a class="row-sm btn-lg" href="/users/{{$usuario->id}}"><i class="fas fa-external-link-alt"></i></a>
          <form class="row-sm" method="POST" action="/users/{{$usuario->id}}">
            @csrf
            @method('delete')
            <button type="submit" class=" btn btn-outline-primary btn-sm" onclick="return confirm('Tem certeza que deseja apagar?');"><i class="fas fa-trash-alt"></i></button>
          </form></div>
        </td>
        </td>
      </tr>        
      <tr>
        <td><div class="font-weight-bold">Nº USP:</div> {{ $usuario->codpes }}</td>          
        <td><div class="font-weight-bold">Status:</div> {{ $usuario->status }}</td>   
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection('content')