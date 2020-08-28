<?php

namespace App\Http\Controllers;

use App\Instance;
use Illuminate\Http\Request;
use App\Http\Requests\InstanceRequest;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->busca)) {
            $instances = Instance::where('tombo','LIKE',"%{$request->busca}%")->paginate(10);
        } else {
            $instances=Instance::paginate(15);
        }
        return view('instance.index')->with("instances",$instances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instance.create')->with('instance',new Instance);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstanceRequest $request)
    {
        $validated = $request->validated();

        Instance::create($validated);

        return redirect('/instance');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instance)
    {
        return view('instance.show')->with('instance',$instance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instance)
    {
        return view('instance.edit')->with('instance',$instance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function update(InstanceRequest $request, Instance $instance)
    {
        $validated = $request->validated();
        $instance->update($validated);

        return redirect("instance/$instance->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance)
    {
        $instance->delete();
        return redirect('/instance');
    }
}
