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
        $this->authorize('nao_usado');
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
    public function create()
    {
        $this->authorize('nao_usado');
        return view('emprestimos.create')->with('emprestimo', new Emprestimo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoRequest $request)
    {
        $this->authorize('nao_usado');
        $validated = $request->validated();
        //$emprestimo->data_devolucao = $request->input('data_devolucao')->addDays(20); input para adicionar datas
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
        $this->authorize('nao_usado');
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
        $this->authorize('nao_usado');
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
        $this->authorize('nao_usado');
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
        $this->authorize('nao_usado');
        $emprestimo->delete();
        return redirect('/emprestimo');
    }
}
