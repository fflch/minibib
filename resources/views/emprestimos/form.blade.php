<!-- instance_id
data_emprestimo
data_devolucao
user_id
n_usp -->
<input type="hidden" name="instances_id" value="{{ $emprestimo->emprestimo->id }}">

<div class="form-group">
    <div class="form-row">
    
        <div class="form-group col"><h6 class="font-weight-bold">Tombo:</h6>
            {{ $emprestimo->emprestimo->tombo ?? '' }}</div>
    
        <div class="form-group col"><h6 class="font-weight-bold">Título:</h6>
        </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col data_emprestimo"><h6 class="font-weight-bold">Data do Empréstimo:</h6>
            </div>
        <div class="form-group col"><h6 class="font-weight-bold">Data Marcada Para Devolução:</h6>
       </div>
        
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="n_usp">Número USP do Aluno:</label>
            <input type="text" class="form-control" id="n_usp" name="n_usp" value="n_usp">
        </div>    
    </div>
</div>    
<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Confirmar Empréstimo</button>
    <a class="btn btn-success" href="/emprestimo" role="button">Voltar</a>
</div>



