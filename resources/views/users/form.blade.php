<div class="form-group">
    <div class="form-row">
        <div class="form-group col-md-8 font-weight-bold">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name',$usuario->name)}}">
        </div>
        <div class="form-group col-md-4 font-weight-bold">
            <label for="codpes">Nº USP:</label>
            <input type="text" class="form-control" id="codpes" name="codpes" value="{{old('codpes',$usuario->codpes)}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-8 font-weight-bold">
            <label for="email">E-mail USP:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="email@usp.br" value="{{old('email',$usuario->email)}}">
            <label for="status" class="required"><b>Status: </b></label>          
            <select name="status" class="form-control" id="status">

            <option value="" selected="">- Selecione -</option>
            @foreach ($usuario->statusOptions() as $option)

                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('status') == '' and isset($usuario->status))
                <option value="{{$option}}" {{ ( $usuario->status == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('status') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
                
            @endforeach
            </select> 
        </div>
        <div class="form-group col-md-4 font-weight-bold">
            <label for="password">Senha Única:</label>
            <input type="password" class="form-control" id="password" name="password">
            <label for="password">Repetir Senha:</label>
            <input type="password" class="form-control" name="password_repeat">
        </div>
    </div>
</div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a class="btn btn-success" href="/users" role="button">Voltar</a>
</div>