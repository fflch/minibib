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

        $query = Record::join('instances','records.id','instances.record_id')
            ->orderBy('records.created_at','desc')
            ->toBase();

        $query->when($request->busca, function ($query) use ($request) {
                $query->where('records.titulo','like','%'.$request->busca.'%')
                    ->orwhere('records.isbn',$request->busca);
        });

        return view('statistic.show')->with([
            'instance' => Instance::count('id'),
            'record'   => Record::count('id'),
            'materiais' => $query->paginate(15),
        ]);
    }

    //issue: está repetindo o material
    public function exportarMaterial(Excel $excel, Record $record, Request $request){
        $query = Record::select($record::camposMateriais());

        $query->when($request->busca, function ($query) use ($request) {
            $query->where('records.titulo','like','%'.$request->busca.'%')
                  ->orwhere('records.isbn',$request->busca);
        });
        $records = $query->toBase()->get()->toArray();

        $export = new ExcelExport($records, $record::camposMateriais());
        return $excel->download($export, "Materiais: $request->busca.xlsx");

    }

    //exporta todos as instances com seus titulos
    public function exportarExemplares(Excel $excel, Instance $instance, Request $request){
        $query = Instance::join('records','records.id','instances.record_id')
            ->select($instance::camposExemplares());

        $query->when($request->busca, function ($query) use ($request) {
            $query->where('records.titulo','like','%'.$request->busca.'%')
                ->orwhere('instances.tombo',$request->busca)
                ->orwhere('records.isbn',$request->busca);
        });
        $instances = $query->toBase()->get()->toArray();

        $export = new ExcelExport($instances, $instance::camposExemplares());
        return $excel->download($export, "Exemplares: $request->busca.xlsx");
    }

    //lista records com join nas instances
    public function exportarMateriaisCompletos(Excel $excel, Record $record, Request $request){
        $query = Record::join('instances','instances.record_id','records.id')
            ->select($record::camposCompletos());

        $query->when($request->busca, function ($query) use ($request) {
            $query->where('records.titulo','like','%'.$request->busca.'%')
                ->orwhere('records.isbn',$request->busca)
                ->orwhere('instances.tombo',$request->busca);
        });

        $records = $query->get()->toArray();

        $export = new ExcelExport($records, $record::camposCompletos());
        return $excel->download($export, "Materiais_Completos: $request->busca .xlsx");
    }

}
