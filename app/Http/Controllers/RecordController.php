<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Record::all();
        return view('records.index',compact('records'));
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
        $record = New Record;

        $record->autores = $request->autores;
        $record->titulo = $request->titulo;
        $record->desc_f = $request->desc_f;
        $record->editora = $request->editora;
        $record->assunto = $request->assunto;
        $record->local_p = $request->local_p;
        $record->localizacao = $request->localizacao;
        $record->edicao = $request->edicao;
        $record->ano = $request->ano;
        $record->idioma = $request->idioma;
        $record->isbn = $request->isbn;
        $record->issn = $request->issn;
        $record->tipo = $request->tipo;
        $record->save();
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
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
