<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use App\Models\Instance;
use App\Models\User;
use App\Models\Record;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->busca)) {
            $emprestimos = Emprestimo::whereHas('instances', function (Builder $query) use ($request) {
                $query->where('tombo','LIKE',"%{$request->busca}%");
            })->orWhere('n_usp','LIKE',"%{$request->busca}%")->paginate(15);
        } else {
            $emprestimos = Emprestimo::paginate(15);
        }
        return view ('emprestimos.index')->with('emprestimos', $emprestimos); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Instance $instances, Record $record)
    {
        $instances = Emprestimo::find($instances, ['id','tombo']);
        $record = Record::find($record, 'titulo');
        return view('emprestimos.create', compact('instances','record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoRequest $request)
    {
        $validated = $request->validated();

        $emprestimo->n_usp = $request->n_usp; // pessoa q ta levando o livro
        $emprestimo->user_id = 1;  //Emprestando;

        Emprestimo::create($validated);

        return redirect('/emprestimo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function show($emprestimo)
    {
        $emprestimo = Emprestimo::with('instances:id,tombo')->find($emprestimo);
        return view('emprestimos.show')->with([
            'emprestimo', $emprestimo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit($emprestimo)
    {
        $emprestimo = Emprestimo::with('instances:id,tombo')->find($emprestimo);
        return view('emprestimos.show')->with([
            'emprestimo', $emprestimo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        $validated = $request->validated();
        $emprestimo->update($validated);

        return redirect("emprestimo/$emprestimo->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprestimo $emprestimo)
    {
        $emprestimo->delete();
        return redirect('/emprestimo');
    }
}
