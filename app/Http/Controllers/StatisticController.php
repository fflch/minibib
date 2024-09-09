<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instance;
use App\Models\Record;
use Maatwebsite\Excel\Excel;
use App\Exports\ExcelExport;
use Rap2hpoutre\FastExcel\FastExcel;

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

    //exporta todos os materiais
    public function exportarMaterial(Excel $excel, Record $record){
        $campos = $record::camposMateriais();
        $records = Record::select($campos)->get();
        $newRecords = $records->toArray();
        $export = new ExcelExport($newRecords, $campos);
        return $excel->download($export, 'materiais.xlsx');
        
    }

    //exporta todos os exemplares
    public function exportarExemplares(Excel $excel, Instance $instance){
        $campos = $instance::camposExemplares();
        $instances = Instance::select($campos)->get();
        $newInstances = $instances->toArray();
        $export = new ExcelExport($newInstances, $campos);
        return $excel->download($export, 'exemplares.xlsx');
    }

    //lista records com join nas instances
    public function exportarMateriaisCompletos(Excel $excel, Record $record){
        $campos = $record::camposCompletos();
        $records = Record::join('instances','instances.record_id','records.id')
        ->select($campos)
        ->get();
        $newRecords = $records->toArray();
        $export = new ExcelExport($newRecords, $campos);
        return $excel->download($export, 'materiais_completos.xlsx');
    }

}
