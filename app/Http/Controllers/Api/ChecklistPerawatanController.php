<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChecklistPerawatanResource;
use App\Models\Checklist;
use App\Models\ChecklistDetail;
use App\Models\CPerawatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ChecklistPerawatanController extends Controller
{
    //
    public function index($kdPat, $kode)
    {
    	$data = CPerawatan::with([
				'detail'
			], 'assigns')
			->whereKdAlat($kode)
			->whereHas('assigns', function($query) use($kdPat) {
				$query->where('kd_pat', '=', $kdPat);
			})
			->get();
    	
    	return ChecklistPerawatanResource::collection($data);
    }

	public function store(Request $request)
    {
    	try {
    		DB::beginTransaction();

    		$data = new Checklist;
    		$data->kd_pat = $request->kd_pat;
    		$data->created_by = $request->created_by;
    		$data->no_inventaris = $request->no_inventaris;
    		$data->assign_id = $request->assign_id;
    		$data->save();
			
    		if (!empty($request->forms)) {
    			foreach ($request->forms as $key => $row) {
    				$detail = new ChecklistDetail;

    				$detail->nama = !empty($row['nama'])?$row['nama']:"";
    				$detail->value = !empty($row['value'])?$row['value']:"";
    				$detail->keterangan = !empty($row['keterangan'])?$row['keterangan']:"";

    				if ($request->hasFile("forms.$key.foto")) {
					    $file = $request->file("forms.$key.foto");
					    $extension = $file->getClientOriginalExtension();

					    $dir = 'checklist/'.$data->id;
					    cekDir($dir);

					    $filename = 'checklist_detail_'.$key.'.jpg';
					    $fullpath = $dir .'/'. $filename;

					    Storage::disk('local')->put($fullpath, File::get($file));

					    $detail->foto = $fullpath;
					}

                    $data->detail()->save($detail);
    			}
    		}

            DB::commit();

            return response()->json(array(
                'code'      => 200,
                'message'   => 'success',
                'data'      => null,
                200
            ));
    	} catch(Exception $e) {
            DB::rollback();

            return response()->json(array(
                'code'      => 400,
                'message'   => 'error',
                'data'      => $e->getMessage(),
                400
            ));
    	}
    }
}
