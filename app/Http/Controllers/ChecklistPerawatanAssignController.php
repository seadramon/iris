<?php

namespace App\Http\Controllers;

use App\Models\CPerawatan;
use App\Models\CPerawatanAssign;
use App\Models\Pat;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChecklistPerawatanAssignController extends Controller
{
    public function index(){
        return view('pages.checklist-perawatan-assign.index');
    }

    public function data()
    {
        $query = CPerawatanAssign::with('form_checklist', 'checklist')->select('iris_c_perawatan_assigns.*');

        return DataTables::eloquent($query)
                ->editColumn('periode_awal', function ($model) {
                    return date('d-m-Y', strtotime($model->periode_awal));
                })
                ->editColumn('periode_akhir', function ($model) {
                    return date('d-m-Y', strtotime($model->periode_akhir));
                })
                ->addColumn('submitted', function ($model) {
                    if($model->checklist){
                        return '<i class="fas fa-check text-success fs-2x"></i>';
                    }
                    return '<i class="fas fa-times text-danger fs-2x"></i>' ;
                })
                ->addColumn('menu', function ($model) {
                    $edit = '<div class="btn-group">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . route('checklist-perawatan-assign.edit', ['id' => $model->id]) . '">Edit</a></li>
                                <li><a class="dropdown-item delete" href="javascript:void(0)" data-id="' .$model->id. '" data-toggle="tooltip" data-original-title="Delete">Delete</a></li>
                            </ul>
                            </div>';

                    return $edit;
            })
            ->rawColumns(['submitted', 'menu'])
            ->toJson();
    }

    public function create()
    {
        $form = CPerawatan::all()->pluck('nama', 'id')->toArray();
        $labelform = ["" => "- Pilih Form -"];
        $forms = $labelform + $form;

        $pat = Pat::all()->pluck('ket', 'kd_pat')->toArray();
        $labelPat = ["" => "- Pilih PAT/PPU -"];
        $pat = $labelPat + $pat;
        return view('pages.checklist-perawatan-assign.create', ['data' => null, 'forms' => $forms, 'pat' => $pat]);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'c_perawatan_id' => 'required',
                'kd_pat'         => 'required',
                'periode_awal'   => 'required',
                'periode_akhir'  => 'required'
            ])->validate();

            $data = new CPerawatanAssign;
            $data->c_perawatan_id = $request->c_perawatan_id;
            $data->kd_pat         = $request->kd_pat;
            $data->periode_awal   = $request->periode_awal;
            $data->periode_akhir  = $request->periode_akhir;
            $data->save();

            DB::commit();

            $flasher->addSuccess('Data telah berhasil dibuat!');
        } catch(Exception $e) {
            DB::rollback();
            $flasher->addError('Error. ' . $e->getMessage());
            return redirect()->route('checklist-perawatan-assign.create');
        }

        return redirect()->route('checklist-perawatan-assign.index');
    }

    public function edit($id)
    {
        $data = CPerawatanAssign::find($id);
        $form = CPerawatan::all()->pluck('nama', 'id')->toArray();
        $labelform = ["" => "- Pilih Form -"];
        $forms = $labelform + $form;

        $pat = Pat::all()->pluck('ket', 'kd_pat')->toArray();
        $labelPat = ["" => "- Pilih PAT/PPU -"];
        $pat = $labelPat + $pat;

        return view('pages.checklist-perawatan-assign.create', [
            'data' => $data,
            'forms' => $forms,
            'pat' => $pat
        ]);
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        DB::beginTransaction();

        try {
        	$validator = Validator::make($request->all(), [
                'c_perawatan_id' => 'required',
                'kd_pat'            => 'required',
                'periode_awal'      => 'required',
                'periode_akhir'     => 'required'
            ])->validate();

            $data = CPerawatanAssign::find($id);
            $data->c_perawatan_id = $request->c_perawatan_id;
            $data->kd_pat         = $request->kd_pat;
            $data->periode_awal   = $request->periode_awal;
            $data->periode_akhir  = $request->periode_akhir;
            $data->save();

            DB::commit();

            $flasher->addSuccess('Data telah berhasil diperbarui!');
        } catch(Exception $e) {
            DB::rollback();
            $flasher->addError('Error. ' . $e->getMessage());
            return redirect()->route('checklist-perawatan-assign.edit', $id);
        }

        return redirect()->route('checklist-perawatan-assign.index');
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = CPerawatanAssign::find($request->id);
            $data->delete();
            DB::commit();

            return response()->json(['result' => 'success'])->setStatusCode(200, 'OK');
        } catch(Exception $e) {
            DB::rollback();
            return response()->json(['result' => $e->getMessage()])->setStatusCode(500, 'ERROR');
        }
    }
}
