<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
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
            $usuario = User::where('codpes','LIKE',"%{$request->busca}%")->paginate(10);
        } else {
            $usuario=User::paginate(15);
        }
        return view('users.index')->with("usuarios",$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('nao_usado');
        return view('users.create')->with('usuario',new User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('nao_usado');
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect('/users');
    }

   /**
     * Display the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        $this->authorize('nao_usado');
        return view('users.show')->with('usuario',$usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $this->authorize('nao_usado');
        return view('users.edit')->with('usuario',$usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $usuario)
    {
        $this->authorize('nao_usado');
        $validated = $request->validated();
        $usuario->update($validated);

        return redirect("users/$usuario->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $this->authorize('nao_usado');
        $usuario->delete();
        return redirect('/users');
    }
}

