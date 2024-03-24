<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FPerbaikan;
use App\Models\Signature;
use App\Models\UsedMaterial;
use App\Http\Resources\FPerbaikanResource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FPerbaikanController extends Controller
{
	public function index(Request $request)
	{
		$status = $request->status;

		$data = FPerbaikan::with([
			'signatures',
			'inventory' => function($sql){
				$sql->with('location');
			}
		]);

		if (!empty($status)) {
			$data->where('status', $status);
		}

		return FPerbaikanResource::collection($data->get());
	}


	public function pelapor(Request $request)
	{
		try {
			DB::beginTransaction();

			$data = new FPerbaikan;

			$data->no_inventaris = $request->no_inventaris;
			$data->kerusakan = $request->kerusakan;
			$data->penyebab = $request->penyebab;
			$data->penanganan = $request->penanganan;
			$data->waktu_kerusakan = $request->waktu_kerusakan;
			$data->status = 'baru';

			$data->save();
			$id = $data->id;

			// kerusakan_path
			if ($request->hasFile('foto')) {
			    $file = $request->file('foto');
			    $extension = $file->getClientOriginalExtension();

			    $dir = 'perbaikan/' . $id;
			    cekDir($dir);

			    $filename = 'kerusakan.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $dataFoto = FPerbaikan::find($id);
			    $dataFoto->kerusakan_path = $fullpath;

			    $dataFoto->save();
			}
			// end:kerusakan_path

			$signature = new Signature;
			$signature->posisi = 'pelapor';
			$signature->sign_by = $request->created_by;
			// sign_path
			if ($request->hasFile('sign')) {
			    $file = $request->file('sign');
			    $extension = $file->getClientOriginalExtension();

			    $dir = 'perbaikan/' . $id . '/sign';
			    cekDir($dir);

			    $filename = 'pelapor.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $signature->sign_path = $fullpath;
			}
			// end:sign_path

			$data->signatures()->save($signature);

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

	public function teknisi(Request $request)
	{
		try {
			DB::beginTransaction();

			$id = $request->id;
			$data = FPerbaikan::find($id);

			$data->prediksi_teknisi = $request->prediksi_teknisi;
			$data->estimasi_teknisi = $request->estimasi_teknisi;
			$data->perbaikan = implode("|", $request->perbaikan);
			$data->catatan = $request->catatan;
			$data->perbaikan_mulai = $request->perbaikan_mulai;
			$data->perbaikan_selesai = $request->perbaikan_selesai;
			$data->mengganggu = $request->mengganggu;
			$data->status = 'teknisi';

			// perbaikan_path
			if ($request->hasFile('foto')) {
			    $file = $request->file('foto');
			    $extension = $file->getClientOriginalExtension();

			    $dir = 'perbaikan/' . $id;
			    cekDir($dir);

			    $filename = 'perbaikan.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $data->perbaikan_path = $fullpath;
			}
			// end:perbaikan_path

			$data->save();

			$signature = new Signature;
			$signature->posisi = 'teknisi';
			$signature->sign_by = $request->created_by;
			// sign_path
			if ($request->hasFile('sign')) {
			    $file = $request->file('sign');
			    $extension = $file->getClientOriginalExtension();

			    $dir = 'perbaikan/' . $id . '/sign';
			    cekDir($dir);

			    $filename = 'teknisi.' . $extension;
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

	public function approval(Request $request)
	{
		try {
			DB::beginTransaction();

			$id = $request->id;
			$data = FPerbaikan::find($id);

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

			    $dir = 'perbaikan/' . $id . '/sign';
			    cekDir($dir);

			    $filename = $request->posisi .'.' . $extension;
			    $fullpath = $dir .'/'. $filename;

			    Storage::disk('local')->put($fullpath, File::get($file));

			    $signature->sign_path = $fullpath;
			}
			// end:sign_path
			$data->signatures()->save($signature);

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
