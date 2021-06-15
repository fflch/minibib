<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instance;
use App\Models\Record;

class StatisticController extends Controller
{
    public function contar(Instance $instance, Record $record)
    {
        $this->authorize('admin');
        $instance = Instance::count('id');
        $record = Record::count('id');
        return view('statistic.show')->with([
            'instance' => $instance,
            'record'   => $record,
        ]);
    }
}
