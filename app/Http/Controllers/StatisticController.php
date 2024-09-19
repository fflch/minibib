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

    public function index(Request $request)
    {
        $this->authorize('admin');
        $instance = Instance::count('id');
        $record = Record::count('id');

        if(isset($request->busca)){
            $materiais = Record::join('instances','records.id','instances.record_id')
            ->where('records.titulo','like','%'.$request->busca.'%')
            ->orwhere('records.isbn',$request->busca)
            ->toBase()
            ->orderBy('records.created_at','desc')
            ->paginate(15);
        }else{
            $materiais = Record::join('instances','records.id','instances.record_id')
            ->toBase()
            ->orderBy('records.created_at','desc')
            ->paginate(15);
        }
        return view('statistic.show')->with([
            'instance' => $instance,
            'record'   => $record,
            'materiais' => $materiais,
        ]);
    }

    //issue: está repetindo o material
    public function exportarMaterial(Excel $excel, Record $record, Request $request){
        $records = Record::select($record::camposMateriais())
        ->where('records.titulo','like','%'.$request->busca.'%')
        ->orwhere('records.isbn',$request->busca)
        ->toBase()
        ->get()
        ->toArray();

        $export = new ExcelExport($records, $record::camposMateriais());
        return $excel->download($export, "Materiais: $request->busca.xlsx");
        
    }

    //exporta todos as instances com seus titulos
    public function exportarExemplares(Excel $excel, Instance $instance, Request $request){
        $instances = Instance::join('records','records.id','instances.record_id')
        ->select($instance::camposExemplares())
        ->where('records.titulo','like','%'.$request->busca.'%')
        ->orwhere('records.isbn',$request->busca)
        ->orwhere('instances.tombo',$request->busca)
        ->toBase()
        ->get()
        ->toArray();
        $export = new ExcelExport($instances, $instance::camposExemplares());
        return $excel->download($export, "Exemplares: $request->busca.xlsx");
    }

    //lista records com join nas instances
    public function exportarMateriaisCompletos(Excel $excel, Record $record, Request $request){
        $records = Record::join('instances','instances.record_id','records.id')
        ->select($record::camposCompletos())
        ->where('records.titulo','like','%'.$request->busca.'%')
        ->orwhere('records.isbn',$request->busca)
        ->orwhere('instances.tombo',$request->busca)
        ->get()
        ->toArray();
        $export = new ExcelExport($records, $record::camposCompletos());
        return $excel->download($export, "Materiais_Completos: $request->busca .xlsx");
    }

}
