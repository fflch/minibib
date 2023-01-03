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
            $emprestimos = Emprestimo::whereNull('data_devolucao')->where('n_usp','LIKE',"%{$request->busca}%");
        } else {
            $emprestimos = Emprestimo::whereNull('data_devolucao');
        }

        $emprestimos = Emprestimo::orderBy('data_emprestimo','desc')->paginate(30);

        return view('emprestimos.index',[
            'emprestimos' => $emprestimos
        ]);

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
     * Método que realiza empréstimo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoRequest $request)
    {
        $this->authorize('admin');

        $validated = $request->validated();
        $validated['data_emprestimo']= Carbon::now()->toDateString();
        $validated['user_id']= auth()->user()->id;

        Emprestimo::create($validated);

        return redirect('/emprestimos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function show(Emprestimo $emprestimo)
    {
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
     * Usando o método update para devolução
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        $emprestimo->data_devolucao = Carbon::now();
        $emprestimo->save();
        return redirect('/emprestimos');
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
        return redirect('/');
    }
}
