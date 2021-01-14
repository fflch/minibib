<!-- instance_id
data_emprestimo
data_devolucao
user_id
n_usp -->
<input type="hidden" name="instance_id" value="{{ $instance->id }}">

<div class="form-group">
    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Tombo do Material:</h5>
        <h4>{{ $instance->tombo }}</h4></div>

        <div class="form-group col"><h5 class="font-weight-bold">Título do Material: </h5>
          <h4>{{ $instance->record->titulo }}</h4>
        </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="n_usp"><h5 class="font-weight-bold">Número USP do Aluno:</h5></label>
            <input type="text" class="form-control" id="n_usp" name="n_usp" value="{{ old('n_usp',$emprestimo->n_usp) }}"> 
        </div>
    </div>
</div>
<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Confirmar Empréstimo</button>
    <a class="btn btn-success" href="/instances/{{$instance->id}}" role="button">Voltar</a>
</div>



