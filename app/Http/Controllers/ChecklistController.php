<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Yajra\DataTables\Facades\DataTables;

class ChecklistController extends Controller
{
    public function index(){
        // $query = Perawatan::with('assigns.form_perawatan')->get();
        // return response()->json($query);
        return view('pages.checklist.index');
    }

    public function data()
    {
        $query = Checklist::with('personal','assigns.form_checklist')->select('*');
            
        return DataTables::eloquent($query)
                ->editColumn('created_by',function ($model){
                    return $model->personal->first_name. ' ' . $model->personal->last_name;
                })
                ->addColumn('menu', function ($model) {
                    $view = '';
                    if(!empty($model->id)){
                        $view = '<a class="btn btn-primary" href="'.route('checklist.view', ['id' => $model->id]).'">View</a>';
                    }
                    return $view;
                })
                ->rawColumns(['menu'])
                ->toJson();
    }

    public function view($id)
    {
        $data = Checklist::with('personal', 'assigns.form_checklist', 'detail')->find($id);
        return view('pages.checklist.view' , ['data' => $data]);
    }
}
