<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function search($pat, Request $request)
    {
    	$perPage = !empty($request->perpage)?$request->perpage:20;

    	$data = Inventory::select('*');
        if($pat != '0A'){
            $data->where('pat_alat', $pat);
        }

    	if (!empty($request->search)) {
    		$search = strtolower($request->search);

    		$data->where(function($query) use($search){
    			$query->where(DB::raw("LOWER(no_inventaris)"), 'like', '%'.$search.'%')
    				->orWhere(DB::raw("LOWER(uraian)"), 'like', '%'.$search.'%');
    		});
    	}

    	return InventoryResource::collection($data->paginate($perPage)->appends($request->except(['page','_token'])), "minimal");
    }

    public function detail($id)
    {
    	$data = InventoryRepository::getAsetById($id);

        return new InventoryResource($data->append('nilai_umur', 'nilai_daya', 'nilai_kondisi', 'nilai_status'));
    }

    public function update($id, Request $request)
    {
    	try {
    		DB::beginTransaction();

    		$data = InventoryRepository::getDetailById($id);

    		if ($request->has('sertifikat_no')) $data->sertifikat_no = $request->sertifikat_no;
    		if ($request->has('sertifikat_tahun')) $data->sertifikat_tahun = $request->sertifikat_tahun;

    		if ($request->hasFile('sertifikat')) $data->sertifikat_path = $this->uploadFile($request->file('sertifikat'), $data->no_inventaris, 'sertifikat');

            if ($request->hasFile('foto1')) $data->foto1_path = $this->uploadFile($request->file('foto1'), $data->no_inventaris, 'foto1');
            if ($request->hasFile('foto2')) $data->foto2_path = $this->uploadFile($request->file('foto2'), $data->no_inventaris, 'foto2');
            if ($request->hasFile('foto3')) $data->foto3_path = $this->uploadFile($request->file('foto3'), $data->no_inventaris, 'foto3');
            if ($request->hasFile('foto4')) $data->foto4_path = $this->uploadFile($request->file('foto4'), $data->no_inventaris, 'foto4');

            $data->save();
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

    private function uploadFile($file, $noInventaris, $name)
    {
        $extension = $file->getClientOriginalExtension();

        $dir = 'inventory/' . $noInventaris;
        cekDir($dir);

        $filename = $name. '.' . $extension;
        $fullpath = $dir .'/'. $filename;

        Storage::disk('local')->put($fullpath, File::get($file));

        return $fullpath;
    }
}
