<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CPerawatan;
use App\Models\CPerawatanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChecklistPerawatanController extends Controller
{
    public function index(){
        return view('pages.checklist-perawatan.index');
    }

    public function data()
    {
        $query = CPerawatan::with('detail')->select('*');
            
        return DataTables::eloquent($query)
                ->addColumn('menu', function ($model) {
                    $edit = '<div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="' . route('checklist-perawatan.edit', $model->id) . '">Edit</a></li>
                        <li><a class="dropdown-item delete" href="javascript:void(0)" data-id="' .$model->id. '" data-toggle="tooltip" data-original-title="Delete">Delete</a></li>
                    </ul>
                    </div>';

                    return $edit;
            })
            ->rawColumns(['menu'])
            ->toJson();
    }

    public function create()
    {
        $alat = Category::select('ket', 'kd_alat')
            ->get()
            ->pluck('ket', 'kd_alat')
            ->toArray();
        $labelAlat = ["" => "- Pilih Alat -"];
        $alat = $labelAlat + $alat;
        return view('pages.checklist-perawatan.create', ['alat' => $alat]);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        try {
            DB::beginTransaction();

            Validator::make($request->all(), [
                'kd_alat' => 'required'
            ])->validate();

            $cat = Category::find($request->kd_alat);
            $data = new CPerawatan();
            $data->nama    = $cat->ket;
            $data->kd_alat = $request->kd_alat;
            $data->save();

            DB::commit();

            $flasher->addSuccess('Data telah berhasil dibuat!');
        } catch(Exception $e) {
            DB::rollback();

            $flasher->addError($e->getMessage());
        }

        return redirect()->route('checklist-perawatan.edit', $data->id);
    }

    public function edit($id)
    {
        $data = CPerawatan::find($id);
        $alat = Category::select('ket', 'kd_alat')
            ->get()
            ->pluck('ket', 'kd_alat')
            ->toArray();
        $labelAlat = ["" => "- Pilih Alat -"];
        $alat = $labelAlat + $alat;

        return view('pages.checklist-perawatan.create', compact('data', 'alat'));   
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        try {
            DB::beginTransaction();

        	Validator::make($request->all(), [
                'kd_alat'          => 'required'
            ])->validate();

            $cat = Category::find($request->kd_alat);
            $formPerawatan = CPerawatan::find($id);
            $formPerawatan->nama    = $cat->ket;
            $formPerawatan->kd_alat = $request->kd_alat;
            $formPerawatan->save();

            //Detail
            $detailIds = array();

            foreach(($request->form_perawatan_detail ?? []) as $detail){
                $arrayPilihan = json_decode($detail['pilihan'] ?? null) ?? [];
                $listPilihan = [];

                foreach($arrayPilihan as $pilihan){
                    $listPilihan[] = $pilihan->value;
                }

                $detailIds[] = CPerawatanDetail::updateOrCreate([
                    'id'        => $detail['id_detail'] ?? 0,
                ],[
                    'c_perawatan_id'    => $id,
                    'nama'              => $detail['nama_detail'],
                    'jenis'             => $detail['jenis'],
                    'parameter'         => Str::of($detail['nama_detail'])->snake()->value,
                    'pilihan'           => !empty($listPilihan) ? implode('|', $listPilihan) : '',
                    'foto_needed'       => isset($detail['foto_needed']) ? 1 : 0,
                    'keterangan_needed' => isset($detail['keterangan_needed']) ? 1 : 0,
                ])->id;
            }

            if(!empty($detailIds)){
                $formPerawatan->detail()->whereNotIn('id', $detailIds)->delete();
            }else{
                $formPerawatan->detail()->delete();
            }

            DB::commit();

            $flasher->addSuccess('Data telah berhasil diperbarui!');
        } catch(Exception $e) {
            DB::rollback();

            $flasher->addError($e->getMessage());
        }

        return redirect()->route('checklist-perawatan.edit', $id);
    }
    
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {               
            $data = CPerawatan::find($request->id);

            $data->detail()->delete();
            $data->delete();

            DB::commit();

            return response()->json(['result' => 'success'])->setStatusCode(200, 'OK');
        } catch(Exception $e) {
            DB::rollback();

            return response()->json(['result' => $e->getMessage()])->setStatusCode(500, 'ERROR');
        }
    }
}
