<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

use App\Models\FPerawatan;
use App\Models\FPerbaikan;
use App\Models\Signature;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;

class MonitoringController extends Controller
{


    public function index(Request $request)
    {
    	$data = null;
        $status = [
            'baru', 'teknisi', 'operator', 'done'
        ];

        $jenisForm = [
            'perbaikan' => 'App|Models|FPerbaikan',
            'perawatan' => 'App|Models|FPerawatan',
            'pengecekan' => 'App|Models|FPengecekan',
        ];

    	return view('pages.monitoring.index', [
            'data' => $data,
            'statuses' => $status,
            'jenisForm' => $jenisForm
        ]);
    }

    public function data(Request $request)
    {
    	$data = Signature::with('source', 'source.inventory', 'pic', 'source.inventory.location')
    	->where('posisi', 'pelapor')
        ->whereIn('source_type', [FPerbaikan::class, FPerawatan::class])
        ->orderBy('created_at', 'desc');

        if (!empty($request->jenisform)) {
            $jns = str_replace("|", "\\", $request->jenisform);
            $data->where('source_type', $jns);
        }

        if (!empty($request->status)) {
            $status = $request->status;
            $data->whereHasMorph(
                'source',
                [FPerbaikan::class, FPerawatan::class],
                function (Builder $query) use($status){
                    $query->where('status', $status);
                }
            );
        }

        return DataTables::eloquent($data)
            ->editColumn('created_at', function($model) {
                return date('Y-m-d H:i:s', strtotime($model->created_at));
            })
            ->addColumn('alat', function (Signature $signature) {
                return $signature->source->inventory->uraian;
            })
            ->addColumn('location', function (Signature $signature) {
                if (!empty($signature->source->inventory->location)) {
                    return $signature->source->inventory->location->ket;
                } else {
                    return "-";
                }
            })
            ->addColumn('jenis_form', function($model) {
                if(($model->source) instanceof FPerbaikan){
                    $form = 'Perbaikan';
                }else if(($model->source) instanceof FPerawatan){
                    $form = 'Perawatan';
                }else{
                    $form = Str::of($model->source->jenis)->studly()->value;
                }
                return $form;
            })
            ->addColumn('menu', function ($model) {
                $edit = '<div class="btn-group">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="'. route('monitoring.show', ['monitoring'=>$model->id]) .'">View</a></li>
                  </ul>
                </div>';
                return $edit;
            })
            ->rawColumns(['menu'])
            ->toJson();
    }

    public function show($id)
    {
        $sign = Signature::find($id); //posisi pelapor
        $form = strtolower(str_replace("App\Models\F", "f", $sign->source_type));
        $data = $sign->source;

        $pengecekanDetail = [];
        $inventory = $data->inventory ?? null;
        $sukucadang = $data->usedMaterials ?? [];
        $signatures = $data->signatures->sortBy('created_at') ?? null;

        if ($form=="fpengecekan") {
            $temps = $data->detail ?? null;

            if (!empty($temps)) {
                foreach ($temps as $temp) {
                    // dd($temp->pengecekan_id);
                    if (!empty($temp->item)) {
                        $pengecekanDetail[$temp->item] = [
                            'parameter' => Str::studly($temp->parameter),
                            'nilai' => $temp->nilai
                        ];
                    } else {
                        $pengecekanDetail[] = [
                            'parameter' => Str::studly($temp->parameter),
                            'nilai' => $temp->nilai
                        ];
                    }
                }
            }
        }

        $posisi = [];

        if (count($signatures) > 0) {
            foreach ($signatures as $signature) {
                switch ($signature->posisi) {
                    case 'teknisi':
                        $posisi['teknisi'] = $signature;
                        break;
                    case 'operator':
                        $posisi['operator'] = $signature;
                        break;
                    case 'manajer':
                        $posisi['manajer'] = $signature;
                        break;
                }
            }
        }

        return view('pages.monitoring.' . $form, [
            'sign' => $sign,
            'data' => $data,
            'inventory' => $inventory,
            'sukucadang' => $sukucadang,
            'signatures' => $signatures,
            'posisi' => $posisi,
            'cekdetails' => $pengecekanDetail
        ]);
    }
}
