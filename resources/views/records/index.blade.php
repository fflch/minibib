@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<div class="card">
  <div class="card-body">
    <table class="table table-striped"> 
      <thead class="card-header">
        <tr>
          <th>Avisos</th>
          <th>Ações</th>
        </tr>  
      </thead>
      <tbody>
        @foreach($records as $record)
        <tr>
          <td>{{$record->titulo}}</a></td>
          <td >
            <a class="row-sm" href="/records/{{$record->id}}/edit"><i class="far fa-edit"></i></a>
            <a class="row-sm" href="/records/{{$record->id}}"><i class="fas fa-external-link-alt"></i></a>
           
          
            <form class="row-sm" method="POST" action="/records/{{$record->id}}">
              @csrf
              
              <button type="submit" class=" btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt"></i></button>
            </form> 
          </td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>


@endsection