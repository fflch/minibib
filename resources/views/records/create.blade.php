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
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="livro"> Livro
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="panfleto"> Panfleto
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="tese"> Tese
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="periodico"> Periódico
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="artigo_p"> Artigo de Periódico
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="manuscrito"> Manuscrito
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="iconografico"> Iconográfico
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="audiovisual"> Audiovisual
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="musica"> Música (Som)
        </label>
        <label class="btn btn-outline-info">
            <input type="radio" name="options" id="partitura"> Partitura
        </label>
    </div>
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