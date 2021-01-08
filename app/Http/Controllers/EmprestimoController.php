<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use App\Models\Instance;
use App\Models\User;
use App\Models\Record;
use Carbon\Carbon;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
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
    public function create(Instance $instance)
    {
        $this->authorize('admin');
        return view('emprestimos.create')->with([
            'instance' => $instance,
            'emprestimo' => New Emprestimo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoRequest $request)
    {
        $this->authorize('admin');

        $validated = $request->validated();
        $validated['data_emprestimo']= Carbon::now()->toDateString();
        $validated['user_id']= 1;

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
        $this->authorize('nao_usado');
        return view('emprestimos.show')->with([
            'emprestimo' => $emprestimo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instance, Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        return view('emprestimos.edit')->with([
            'emprestimo' => $emprestimo,
            'instance' => $instance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(EmprestimoRequest $request, Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $validated['data_devolucao']= Carbon::now()->toDateString();
        $validated['user_id']= 1;
        $emprestimo->update($request->validated());

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
        $this->authorize('admin');
        $emprestimo->delete();
        return redirect('/emprestimo');
    }
}
