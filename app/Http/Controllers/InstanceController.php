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
     * Não possui index porque Instance está inserida em Record
     */
    public function index(Request $request)
    {
    }

    /**
     * Cria formulário de instance (tombo)
     */
    public function create($record)
    {
        $this->authorize('admin');
        $record = Record::find($record, ['id','titulo']);
        return view('instances.create')->with(['record' => $record]);
    }

    /**
     * Requisita os dados inseridos em instance
     */
    public function store(InstanceRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();

        Instance::create($validated);

        return redirect("/records/{$validated['record_id']}");
    }

    /**
     * Lista
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
     * Edita instance (tombo)
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
     * Edita instance (tombo)
     */
    public function update(InstanceRequest $request, Instance $instance)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $instance->update($validated);

        return redirect("/records/{$validated['record_id']}");
    }

    /**
     * Deleta instance (tombo)
     */
    public function destroy(Instance $instance)
    {
        $this->authorize('admin');
        $instance->delete();
        return redirect('/records');
    }
}
