<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UsedMaterial;
use App\Models\KodeLini;
use App\Models\Spmks;
use App\Models\SpmksDetail;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class UsedMaterialController extends Controller
{
    

    public function index()
    {
        return view('pages.used-material.index');
    }

    public function data()
    {
    	$query = UsedMaterial::with(['material'])->whereRequested('0');

    	return DataTables::eloquent($query)
            ->addColumn('fullname', function($model) {
                $material = !empty($model->material)?$model->material->uraian:"";
                $spek = !empty($model->material)?$model->material->spesifikasi:"";
                $jumlah = !empty($model->jumlah)?$model->jumlah:"";
                return $model->id. '#' .$material.' '.$spek.' '.$jumlah;
            })
	        ->addColumn('menu', function ($model) {
	            $edit = '<div class="btn-group">
	                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
	                Action
	            </button>
	            <ul class="dropdown-menu">
	                <li><a class="dropdown-item" href="' . route('usedmaterial.edit', $model->id) . '">Edit</a></li>
	                <li><a class="dropdown-item delete" href="javascript:void(0)" data-id="' .$model->id. '" data-toggle="tooltip" data-original-title="Delete">Delete</a></li>
	            </ul>
	            </div>';

	            return $edit;
    	    })
    	    ->rawColumns(['menu', 'fullname'])
    	    ->toJson();
    }

    public function findKodelini(Request $request)
    {
        $pat = session('TMP_KDWIL');
        $pat = '2A'; //dev only
        $term = trim($request->q);

        if (empty($term)) {
            return Response::json([]);
        }

        $tags = KodeLini::where('ket', 'like', "%$term%")
            ->where('kd_pat', $pat)
            ->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->kd_lini, 'text' => $tag->ket];
        }

        return Response::json($formatted_tags);
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            if (count($request->permintaan) > 0) {
                $pat = session('TMP_KDWIL');
                // $pat = '2A'; //dev only
                $tmpGen = $pat.'/'.date('m.Y');

                $sql = Spmks::where('no_spmks', 'like', "%$tmpGen")
                    ->orderBy('no_spmks', 'desc')
                    ->first();

                if (!empty($sql)) {
                    $curent = substr($sql->no_spmks, 0, 4);
                    $urutSpmk = sprintf('%04d', $curent+1);
                } else {
                    $urutSpmk = sprintf('%04d', 1);
                }

                $no = $urutSpmk.'/'.$tmpGen;
                $maks = SpmksDetail::where('no_spmks', $no)->max('no_urut');
                $urut = !is_null($maks) ? $maks + 1 : 1;

                $data = new Spmks;
                $data->no_spmks = $no;
                $data->pat_spmks = $pat;
                $data->tgl_spmks = date('Y-m-d');
                $data->created_by = 'LS952568';
                $data->save();

                foreach ($request->permintaan as $row) {
                    $tmp = UsedMaterial::find($row['id_material']);
                    $tmp->requested = 1;
                    $tmp->save();
                    $noInventaris = !empty($tmp->source)?$tmp->source->no_inventaris:"";

                    $detail = new SpmksDetail;
                    $detail->no_spmks = $no;
                    $detail->kd_material = $tmp->kd_material;
                    $detail->vol = $row['qty'];
                    $detail->vol_app = $row['qty'];
                    $detail->no_urut = $urut;
                    $detail->kd_lini = $row['kd_lini'];
                    $detail->no_inventaris = $noInventaris;
                    $detail->save();

                    $urut = $urut+1;
                }

                DB::commit();
                return response()->json(['result' => 'success'])->setStatusCode(200, 'OK');
            }
        } catch(Exception $e) {
            DB::rollback();
            return response()->json(['result' => $e->getMessage()])->setStatusCode(500, 'ERROR');
        }
    }
}
