<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsetRequest;
use App\Http\Requests\UpdateAsetRequest;

use Illuminate\Http\Request;

use App\Repositories\InventoryRepository;
use App\Repositories\SelectRepository;
use Flasher\Prime\FlasherInterface;
use DB;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = null;

        return view('pages.inventory.index');
    }

    public function data()
    {
        $query = InventoryRepository::getData();
            
        return DataTables::eloquent($query)
                ->addColumn('menu', function ($model) {
                $edit = '<div class="btn-group">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="' . route('inventory.show', ['inventory' => $model->no_inventaris]) . '">View</a></li>
                    <li><a class="dropdown-item" href="' . route('inventory.edit', ['inventory' => $model->no_inventaris]) . '">Edit</a></li>
                  </ul>
                </div>';
                return $edit;
            })
            ->rawColumns(['menu'])
                ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAsetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsetRequest $request)
    {
        $disabled = "";
        $data = InventoryRepository::getAsetById($id);
        $selKondisi = SelectRepository::kondisi();
        $selLokasi = SelectRepository::lokasi();

        return view('pages.inventory.edit', [
            'data' => $data,
            'status' => $selKondisi,
            'lokasi' => $selLokasi,
            'disabled' => $disabled
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disabled = "disabled";
        $data = InventoryRepository::getAsetById($id);
        $selKondisi = SelectRepository::kondisi();
        $selLokasi = SelectRepository::lokasi();

        return view('pages.inventory.show', [
            'data' => $data,
            'status' => $selKondisi,
            'lokasi' => $selLokasi,
            'disabled' => $disabled
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disabled = "disabled";
        $data = InventoryRepository::getAsetById($id);
        $selKondisi = SelectRepository::kondisi();
        $selLokasi = SelectRepository::lokasi();
        $pic = SelectRepository::picFullName();

        return view('pages.inventory.edit', [
            'data' => $data,
            'status' => $selKondisi,
            'lokasi' => $selLokasi,
            'disabled' => $disabled,
            'pic' => $pic
        ]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAsetRequest  $request
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        DB::beginTransaction();

        try {
            $data = InventoryRepository::getAsetById($id);

            $data->last_update_by = $request->last_update_by;
            $data->save();

            DB::commit();
            $flasher->addSuccess('Data has been saved successfully!');
        } catch(Exception $e) {
            DB::rollback();
            $flasher->addError('An error has occurred please try again later.');
        }

        return redirect()->route('inventory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aset $aset)
    {
        //
    }
}
