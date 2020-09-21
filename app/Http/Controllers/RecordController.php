<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;
use App\Instance;
use Illuminate\Database\Eloquent\Builder;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        # Buscar por tombo, título e autor 
        if(isset($request->busca)) {
            $records = Record::whereHas('instances', function (Builder $query) use ($request) {
                $query->where('tombo','LIKE',"%{$request->busca}%");
            })->orWhere('titulo','LIKE',"%{$request->busca}%")
              ->orWhere('autores','LIKE',"%{$request->busca}%")->paginate(15);
        } else {
            $records = Record::paginate(15);
        }
        return view('records.index')->with('records',$records);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create')->with('record',new Record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordRequest $request)
    {
        $validated = $request->validated();

        Record::create($validated);

        return redirect('/records');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return view('records.show')->with('record',$record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        return view('records.edit')->with('record',$record);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(RecordRequest $request, Record $record)
    {
        $validated = $request->validated();
        $record->update($validated);

        return redirect("records/$record->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return redirect('/records');
    }
}
