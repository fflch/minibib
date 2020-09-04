<input type="hidden" name="record_id" value="{{ $instance->record->id ??
                                      $record->id }}"
<div class="form-group">
    <div class="form-row">
        <div class="form-group col-md-6 font-weight-bold">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                  value="{{ $instance->record->titulo ?? $record->titulo }}">
        </div>
        <div class="form-group col-md-6 font-weight-bold">
            <label for="tombo">Tombo</label>
            <input type="text" class="form-control" id="tombo" name="tombo"
                  value="{{ $instance->tombo ?? old('tombo') }}">
        </div>
    </div>
</div>
<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
    <a class="btn btn-success" href="/instance" role="button">Voltar</a>
</div>
