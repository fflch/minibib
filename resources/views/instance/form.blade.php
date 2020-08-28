<div class="form-group">
    <div class="form-row">
        <div class="form-group col-md-6 font-weight-bold">
            <label for="record_id">ID do Registro:</label>
            <input type="text" class="form-control" id="record_id" name="record_id" value="{{old('record_id',$instance->record_id)}}">
        </div>
        <div class="form-group col-md-6 font-weight-bold">
            <label for="tombo">Tombo do Registro:</label>
            <input type="text" class="form-control" id="tombo" name="tombo" value="{{old('tombo',$instance->tombo)}}">
        </div>
    </div>
</div>
<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
    <a class="btn btn-success" href="/instance" role="button">Voltar</a>
</div>