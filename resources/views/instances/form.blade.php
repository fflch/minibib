<input type="hidden" name="record_id" value="{{ $instance->record->id ?? $record->id }}">

<div class="form-group">
<div class="col p-4 text-break"><h6 class="font-weight-bold">Título</h6>
          {{ $instance->record->titulo ?? $record->titulo }}</div>
    <div class="form-row">
        <div class="form-group col-md-6 font-weight-bold">
            <label for="tombo">Tombo</label>
            <input type="text" class="form-control" id="tombo" name="tombo" value="{{ $instance->tombo ?? old('tombo') }}">
        </div>
        <div class="form-group col-md-6 font-weight-bold">
            <label for="localizacao">Localização:</label>
            <input type="text" class="form-control" id="localizacao" name="localizacao" value="{{ $instance->localizacao ?? old('localizacao')}}">
        </div>
    </div>
</div>
<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
    <a class="btn btn-success" href="/records/{{ $instance->record->id ?? $record->id }}" role="button">Voltar</a>
</div>
