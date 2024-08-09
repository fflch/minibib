<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;
use App\Models\Instance;
use Illuminate\Database\Eloquent\Builder;
use App\Utils\Idioma;

class RecordController extends Controller
{
    /**
     * PÁGINA INICIAL (LISTA E PESQUISA CADASTROS)
     */
    public function index(Request $request)
    {
        # Buscar por tombo, título e autor 
        if(isset($request->busca)) {
            $records = Record::whereHas('instances', function (Builder $query) use ($request) {
                $query->where('tombo','LIKE',"%{$request->busca}%");
            })->orWhere('titulo','LIKE',"%{$request->busca}%")
              ->orWhere('autores','LIKE',"%{$request->busca}%")->paginate(15);
              $recordsCount = Record::whereHas('instances', function (Builder $query) use ($request) {
                $query->where('tombo','LIKE',"%{$request->busca}%");
            })->orWhere('titulo','LIKE',"%{$request->busca}%")
              ->orWhere('autores','LIKE',"%{$request->busca}%")->count();
        } else {
            $records = Record::paginate(15);
            $recordsCount = Record::count();
        }
        return view('records.index')->with(['records' => $records, 'recordsCount' => $recordsCount]);
    }

    /**
     * CADASTRO DE MATERIAL
     */
    public function create()
    {
        $this->authorize('admin');
        return view('records.create')->with('record',new Record);
    }

    /**
     * REQUISITA E ARMAZENA DADOS INSERIDOS NO CADASTRO
     */
    public function store(RecordRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();

        Record::create($validated);

        return redirect('/records');
    }

    /**
     * LISTA / EXIBE CADASTRO 
     */
    public function show(Record $record)
    {
        $this->authorize('admin');
        return view('records.show')->with('record',$record);
    }

    /**
     * EDITA RECORD (MATERIAL)
     */
    public function edit(Record $record)
    {
        $this->authorize('admin');
        return view('records.edit')->with('record',$record);
    }

    /**
     * EDITA RECORD (MATERIAL)
     */
    public function update(RecordRequest $request, Record $record)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $record->update($validated);

        return redirect("records/$record->id");
    }

    /**
     * DELETA RECORD (MATERIAL)
     */
    public function destroy(Record $record)
    {
        $this->authorize('admin');
        if ($record->instances->isNotEmpty()){
            return redirect('/records')->with('alert-danger', 'Registro ainda contém exemplares. Por favor, delete exemplares antes!');
        }
        $record->delete();
        return redirect('/records');
    }
}
