@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')

<form method="get" action="/emprestimos">
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
<!--  -->

<div class="card">
  <div class="card-body">
    <table class="table">
      <thead class="thead">
@foreach($instances as $instance)
      </thead>
      <tbody>
<tr>
        <td><div class="font-weight-bold">Nº USP:</div> {{ $instance->id }}</td>          
        <td><div class="font-weight-bold">User_id:</div> {{ $instance->n_usp }}</td> 
        <td><div class="font-weight-bold">n_usp:</div> {{ $instance->n_usp}}</td>           
        <td><div class="font-weight-bold">instance:</div> {{ $instance->instance_id }}</td>   

      </tr>
      </tbody>
    </table>
  </div>
</div>


@endforeach

@endsection('content')
