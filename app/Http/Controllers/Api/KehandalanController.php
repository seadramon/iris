<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FKehandalan;
use App\Models\Signature;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class KehandalanController extends Controller
{
    //
    //
    public function submitEvaluasi(Request $request)
    {
    	try {
			DB::beginTransaction();

			$data = new FKehandalan;
			$data->no_inventaris = $request->no_inventaris;
			$data->periode_mulai = $request->periode_mulai;
			$data->periode_selesai = $request->periode_selesai;
			$data->kehandalan = $request->kehandalan;
			$data->kemudahan_perbaikan = $request->kemudahan_perbaikan;
			$data->kemudahan_sukucadang = $request->kemudahan_sukucadang;
			$data->penggunaan = $request->penggunaan;
			$data->jumlah = $request->jumlah;
			$data->rekomendasi = $request->rekomendasi;
			$data->save();

			$id = $data->id;

			$signature = new Signature;
			$signature->posisi = 'pelapor';
			$signature->sign_by = $request->created_by;
			if ($request->hasFile('sign')) {
				$file = $request->file('sign');
				$extension = $file->getClientOriginalExtension();

				$dir = 'kehandalan/' . $id . '/sign';
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
