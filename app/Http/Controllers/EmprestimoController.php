<?php

namespace App\Http\Controllers;

use App\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use App\Instance;
use App\User;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Instance $instance)
    {
        // if($request->busca) {
        //     $instances = Emprestimo::with('instance:id,instance_id')
        //         ->where('user_id','LIKE',"%{$request->busca}%")
        //         ->paginate(2);
        // } else {
        //     $instances = Emprestimo::with('instance:id,instance_id')
        //         ->paginate(2);
        // }
        $instances = Emprestimo::find(1); //('instance:id,instance_id');
        //dd($emprestimos);
        //$funcionarios = User::with('user:id,user_id');
        return view ('emprestimos.index')->with("instances", $instances); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emprestimos.create');
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
    public function show(Emprestimo $emprestimo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprestimo $emprestimo)
    {
        //
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
