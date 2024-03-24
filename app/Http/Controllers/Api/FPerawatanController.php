<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FPerawatan;
use App\Models\Signature;
use App\Models\UsedMaterial;
use App\Http\Resources\FPerawatanResource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FPerawatanController extends Controller
{
    public function index(Request $request)
	{
		$status = $request->status;

		$data = FPerawatan::with([
			'signatures',
			'usedMaterials' => function($sql){
				$sql->with('material');
			},
			'inventory' => function($sql){
				$sql->with('location');
			}
		]);

		if (!empty($status)) {
			$data->where('status', $status);
		}

		return FPerawatanResource::collection($data->get());
	}

	public function store(Request $request)
	{
		try {
			DB::beginTransaction();

			$data = new FPerawatan;

			$data->no_inventaris = $request->no_inventaris;
			$data->pemeriksaan = $request->pemeriksaan;
			$data->pemeriksaan_hasil = $request->pemeriksaan_hasil;
			$data->penanganan = $request->penanganan;
			$data->catatan = $request->catatan;
			$data->status = 'baru';

			$data->save();
			$id = $data->id;

			$signature = new Signature;
			$signature->posisi = 'pelapor';
			$signature->sign_by = $request->created_by;
			// sign_path
			$fullpath = "";
			if ($request->hasFile('sign')) {
			    $file = $request->file('sign');
			    $extension = $file->getClientOriginalExtension();

			    $dir = 'perawatan/' . $id . '/sign';
			    cekDir($dir);

			    $filename = 'pelapor.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $signature->sign_path = $fullpath;
			}
			// end:sign_path
			$data->signatures()->save($signature);

			// used materials
			if (!empty($request->suku_cadang)) {
				foreach ($request->suku_cadang as $row) {
					$usm = new UsedMaterial;

					$usm->kd_material = !empty($row['kode'])?$row['kode']:"";
					$usm->qty = !empty($row['qty'])?$row['qty']:"";
					$usm->catatan = !empty($row['catatan'])?$row['catatan']:"";

					$data->usedMaterials()->save($usm);
				}
			}
			// end:used materials

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
