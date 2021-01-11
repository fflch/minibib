<?php

namespace App\Http\Controllers;

use App\Models\Instance;
use Illuminate\Http\Request;
use App\Http\Requests\InstanceRequest;
use App\Models\Record;
use App\Models\Emprestimo;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($record)
    {
        $this->authorize('admin');
        $record = Record::find($record, ['id','titulo']);
        return view('instances.create')->with(['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstanceRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();

        Instance::create($validated);

        return redirect("/records/{$validated['record_id']}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show($instance)
    {
        $this->authorize('admin');
        $instance = Instance::with('record:id,titulo')->find($instance);
        return view('instances.show')->with([
            'instance' => $instance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit($instance)
    {
        $this->authorize('admin');
        $instance = Instance::with('record:id,titulo')->find($instance);
        return view('instances.edit')->with([
            'instance' => $instance
        ]);
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
        $this->authorize('admin');
        $validated = $request->validated();
        $instance->update($validated);

        return redirect("/records/{$validated['record_id']}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance)
    {
        $this->authorize('admin');
        $instance->delete();
        return redirect('/instances');
    }
}
