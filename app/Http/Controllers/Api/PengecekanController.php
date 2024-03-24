<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FPengecekan;
use App\Models\FPengecekanDetail;
use App\Models\Signature;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PengecekanController extends Controller
{
    
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'no_inventaris' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'failed', 
                'data' => $validator->messages()
            ], 500);
        }

    	try {
    		DB::beginTransaction();

			$data = new FPengecekan;

			$data->no_inventaris = $request->no_inventaris;
			$data->jenis = $request->jenis;
			$data->periode = $request->periode;
			$data->periode_counter = $request->periode_counter;
			if($request->has('periode_mulai')){
				$data->periode_mulai = $request->periode_mulai;
			}
			if($request->has('periode_selesai')){
				$data->periode_selesai = $request->periode_selesai;
			}
			$data->save();

			$id = $data->id;

			// detail
			if (!empty($request->pengecekan)) {
				foreach ($request->pengecekan as $row) {
					$detail = new FPengecekanDetail;

					$detail->item = !empty($row['item'])?$row['item']:"";
					$detail->parameter = !empty($row['parameter'])?$row['parameter']:"";
					$detail->nilai = !empty($row['nilai'])?$row['nilai']:"";

					$data->detail()->save($detail);
				}
			}
			// end:detail

			// SIgnature
			$signature = new Signature;
			$signature->posisi = 'pelapor';
			$signature->sign_by = $request->created_by;

			$fullpath = "";
			if ($request->hasFile('sign')) {
			    $file = $request->file('sign');
			    $extension = $file->getClientOriginalExtension();

			    $dir = 'pengecekan/' . $id . '/sign';
			    cekDir($dir);

			    $filename = 'pelapor.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $signature->sign_path = $fullpath;
			}
			$data->signatures()->save($signature);
			// end:signature

    		DB::commit();
    		return response()->json([
                'message' => 'success',
                'data' => null
            ])->setStatusCode(200, 'OK');
    	} catch(Exception $e) {
    		DB::rollback();

			return response()->json([
                'message' => 'failed',
                'data' => $e->getMessage()
            ])->setStatusCode(500, 'OK');
    	}
    }
}
