<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FPerbaikan;
use App\Models\Signature;
use App\Models\UsedMaterial;
use App\Http\Resources\FPerbaikanResource;
use App\Http\Resources\Setup\PemenuhanListResource;
use App\Models\SetupCetakanDetail;
use App\Models\SetupCetakan;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SetupController extends Controller
{
	public function index(Request $request)
	{
		$status = $request->status;

		$data = SetupCetakanDetail::whereStatus($status);
		
		return PemenuhanListResource::collection($data->get());
	}

	public function submitPemenuhan(Request $request)
	{
		try {
			DB::beginTransaction();

			$id = $request->id;
			$data = SetupCetakanDetail::find($id);

			$data->no_inventaris = $request->no_inventaris;
			$data->tgl_selesai = $request->tgl_selesai;
			$data->qa = $request->qa;
			$data->status = 'setup';
			$data->save();

			$signature = new Signature;
			$signature->posisi = 'pelapor';
			$signature->sign_by = $request->created_by;
			if ($request->hasFile('sign')) {
				$file = $request->file('sign');
				$extension = $file->getClientOriginalExtension();

				$dir = 'perbaikan/' . $id . '/sign';
				$dir = "setup/{$data->setup_id}/detail/{$data->id}/pelapor.jpg";
				cekDir($dir);

				$filename = 'pelapor.' . $extension;
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
		} catch(Exception $e) {
			DB::rollback();
			return response()->json([
				'message' => $e->getMessage(),
				'data' => $e->getMessage()
			])->setStatusCode(500, 'OK');
		}
	}

	public function submitPermohonan(Request $request)
	{
		try {
			DB::beginTransaction();

			// header
			$data = new SetupCetakan;
			$data->kd_jalur = $request->kd_jalur;
			$data->kd_pat = $request->kd_pat;
			$data->kd_cetakan = $request->kd_cetakan;
			$data->ra = $request->ra;
			$data->ri = $request->ri;
			$data->sisa = $request->sisa;
			$data->tgl_pemakaian = $request->tgl_pemakaian;
			$data->save();

			$id = $data->id;
			// detail
			if ((int)$request->sisa > 0) {
				for ($i=1; $i <= $request->sisa ; $i++) { 
					$detail = new SetupCetakanDetail;
					$detail->setup_id = $id;
					$detail->status = "baru";
					$detail->save();
				}
			}

			$signature = new Signature;
			$signature->posisi = 'pelapor';
			$signature->sign_by = $request->created_by;
			if ($request->hasFile('sign')) {
				$file = $request->file('sign');
				$extension = $file->getClientOriginalExtension();

				$dir = 'setup/' . $id . '/sign';
				cekDir($dir);

				$filename = 'pelapor.' . $extension;
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
		} catch(Exception $e) {
			DB::rollback();
			return response()->json([
				'message' => $e->getMessage(),
				'data' => $e->getMessage()
			])->setStatusCode(500, 'OK');
		}
	}
}
