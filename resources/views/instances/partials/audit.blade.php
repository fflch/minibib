<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Data</th>
      <th scope="col">Usuário(a)</th>
      <th scope="col">Campos alterados</th>
      <th scope="col">Alterações</th>
    </tr>
  </thead>
  <tbody>
  @foreach($model->audits as $field => $audit)
    <tr>
      <td> {{ \Carbon\Carbon::parse($audit->getMetadata()['audit_created_at'])->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }} </td>
      <td> {{ $audit->getMetadata()['user_name'] }}</td>
      <td> 
        @foreach($audit->getModified() as $field2=>$modified)
          @if($field)
            <b>{{ $instance->mapeamento($field2) }}: {{ $modified['old'] }}<br>
          @endif
        @endforeach
      </td>
      <td> 
        @foreach($audit->getModified() as $field=>$modified)
          @if($field)
            <b>{{ $instance->mapeamento($field) }}: {{ $modified['new'] }}<br>
          @endif
        @endforeach
      </td>
    </tr>
  @endforeach
  </tdoby>
</table>