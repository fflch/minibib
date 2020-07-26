@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('content')
@include('flash')

<form method="POST" action="/records"> 
@csrf
<div class="card">
    <h5 class="card-header">Cadastro de Material</h5>
    <div class="card-body">
    <div class="form-group">
        <label for="autores">Autores</label>
        <input type="text" class="form-control" id="autores" name="autores" value="{{old('autores')}}">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="titulo">Título</label>
            <textarea type="text" class="form-control" id="titulo" name="titulo">{{old('titulo')}}</textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="desc_f">Descrição física</label>
            <textarea type="text" class="form-control" id="desc_f" name="desc_f" >{{old('desc_f')}}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="editora">Editora</label>
            <input type="text" class="form-control" id="editora" name="editora" value="{{old('editora')}}">
        </div>
        <div class="form-group col-md-6">
            <label for="assunto">Assunto</label>
            <input type="text" class="form-control" id="assunto" name="assunto" value="{{old('assunto')}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="local_p">Local de publicação</label>
            <input type="text" class="form-control" id="local_p" name="local_p" value="{{old('local_p')}}">
        </div>
        <div class="form-group col-md-6">
            <label for="localizacao">Localização</label>
            <input type="text" class="form-control" id="localizacao" name="localizacao" value="{{old('localizacao')}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="edicao">Edição</label>
            <input type="text" class="form-control" id="edicao" name="edicao" value="{{old('edicao')}}">
        </div>
            <div class="form-group col-md-4">
            <label for="ano">Ano</label>
            <input type="text" class="form-control" id="ano" name="ano" value="{{old('ano')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="idioma">Idioma</label>
            <input type="text" class="form-control" id="idioma" name="idioma" value="{{old('idioma')}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{old('isbn')}}">
        </div>
        <div class="form-group col-md-6">
            <label for="issn">ISSN</label>
            <input type="text" class="form-control" id="issn" name="issn" value="{{old('issn')}}">
        </div>
    </div>
    <div class="form-group">
        <label for="tipo" class="required"><b>Escolha o tipo: </b></label>          
            <select name="tipo" class="form-control" id="tipo">

            <option value="" selected="">- Selecione -</option>
            @foreach ($record->tipoOptions() as $option)

                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('tipo') == '' and isset($record->tipo))
                <option value="{{$option}}" {{ ( $estagio->tipo == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('tipo') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
                
            @endforeach
            </select> 
    </div></div>
    </br>
    </br>
    <div class="col-sm form-group">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a class="btn btn-success" href="/records" role="button">Voltar</a>
    </div>
    </div>
</div>
</form>
@endsection