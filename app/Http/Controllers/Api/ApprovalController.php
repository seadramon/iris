<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FPerbaikan;
use App\Models\FPerawatan;
use App\Models\Signature;
use App\Http\Resources\FPerbaikanResource;
use App\Models\SetupCetakanDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ApprovalController extends Controller
{
    
	public function store(Request $request)
	{
		try {
			DB::beginTransaction();

			$source = $request->source;
			$id = $request->id;

			if ($source == "perbaikan") {
				$data = FPerbaikan::find($id);
			} elseif ($source == "perawatan") {
				$data = FPerawatan::find($id);
			} elseif ($source == "setup") {
				$data = SetupCetakanDetail::find($id);
			}

			if ($request->posisi == "manajer") {
				$data->status = "done";
			} else {
				$data->status = $request->posisi;
			}
			$data->save();

			$signature = new Signature;

			$signature->posisi = $request->posisi;
			$signature->sign_by = $request->created_by;
			// sign_path
			if ($request->hasFile('sign')) {
			    $file = $request->file('sign');
			    $extension = $file->getClientOriginalExtension();
			    
			    $dir = $source. '/' . $id . '/sign';
			    cekDir($dir);

			    $filename = $request->posisi. '.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $signature->sign_path = $fullpath;
			}
			$data->signatures()->save($signature);

			DB::commit();

			return response()->json([
                'message' => 'success',
                'data' => null
            ])->setStatusCode(200, 'OK');
		}catch(Exception $e) {
			DB::rollback();

			return response()->json([
                'message' => 'failed',
                'data' => $e->getMessage()
            ])->setStatusCode(500, 'OK');
		}
	}
}
