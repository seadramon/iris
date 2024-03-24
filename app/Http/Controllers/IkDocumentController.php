<?php

namespace App\Http\Controllers;

use App\Models\IkDocument;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Repositories\IkDocumentRepository;
use App\Repositories\SelectRepository;

use Yajra\DataTables\Facades\DataTables;
use Flasher\Prime\FlasherInterface;

use DB;
use Session;
use Validator;
use Storage;

class IkDocumentController extends Controller
{
    protected $cats = ['perbaikan', 'perawatan', 'pengoperasian'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = null;

        return view('pages.ikdocument.index', [
            'data' => $data
        ]);
    }

    public function data()
    {
        $query = IkDocumentRepository::getFromAlat();

        return DataTables::eloquent($query)
                ->addColumn('menu', function ($model) {
                    $ikPath = '';
                    if (count($model->ik_document) > 0) {
                        foreach ($model->ik_document as $ik) {
                            $ikPath .= '<li><a class="dropdown-item" href="' . full_url_from_path($ik->path_file) . '" target="_blank">Ik '. ucwords($ik->category) .'</a></li>';
                        }
                    }
                    $edit = '<div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="' . route('ikdocument.edit', ['ikdocument' => $model->kd_alat]) . '">Edit</a></li>
                        '. $ikPath .'
                        <li><a class="dropdown-item delete" href="javascript:void(0)" data-id="' .$model->kd_alat. '" data-toggle="tooltip" data-original-title="Delete">Delete</a></li>
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
        $data = null;
        $code = SelectRepository::groupCode();
        $category = setCombo(IkDocument::CATEGORY, "- Choose Category -");

        return view('pages.ikdocument.create', [
            'data' => $data,
            'code' => $code,
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'kd_alat' => 'required',
                'doc_perbaikan' => 'file|mimes:pdf',
                'doc_pengoperasian' => 'file|mimes:pdf',
                'doc_perawatan' => 'file|mimes:pdf'
            ])->validate();

            foreach ($this->cats as $row) {
                if ($request->hasFile('doc_' . $row)) {
                    $data = new IkDocument();
                    $data->kd_alat = $request->kd_alat;

                    $data->path_file = self::uploadFile($request->file('doc_' . $row), $row, $request->kd_alat);
                    $data->category = $row;

                    $data->save();
                    DB::commit();
                }
            }

            $flasher->addSuccess('Data has been saved successfully!');
        } catch(Exception $e) {
            DB::rollback();
            $flasher->addError('An error has occurred please try again later.');
        }

        return redirect()->route('ikdocument.index');
    }

    private static function uploadFile($file, $category, $code, $pathfile = null)
    {
        if (!empty($pathfile)) {
            if ( Storage::disk('local')->exists($pathfile) ) {
                Storage::disk('local')->delete($pathfile);
            }
        }

        $extension = $file->getClientOriginalExtension();

        $dir = 'ik_docs/' . $code . '/';
        cekDir($dir);

        $filename = $category.'_'.trim(date('YmdHis')) . '.' . $extension;
        $fullpath = $dir.$filename;

        $up = Storage::disk('local')->put($fullpath, \File::get($file));

        return $fullpath;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IkDocument  $ikDocument
     * @return \Illuminate\Http\Response
     */
    public function show(IkDocument $ikDocument)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IkDocument  $ikDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = IkDocumentRepository::getDocByCode($id);
        $code = Category::where('kd_alat', $id)->first();

        return view('pages.ikdocument.edit', [
            'data' => $data,    
            'code' => $code    
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IkDocument  $ikDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'doc_perbaikan' => 'file|mimes:pdf',
                'doc_pengoperasian' => 'file|mimes:pdf',
                'doc_perawatan' => 'file|mimes:pdf'
            ])->validate();

            foreach ($this->cats as $row) {
                if ($request->hasFile('doc_' . $row)) {
                    $data = IkDocumentRepository::getDocByCode($request->kd_alat, $row);
                    
                    if (empty($data)) {
                        $data = new IkDocument();
                        $data->kd_alat = $request->kd_alat;
                        $data->path_file = self::uploadFile($request->file('doc_' . $row), $row, $request->kd_alat);
                        $data->category = $row;
                    } else {
                        $data->path_file = self::uploadFile($request->file('doc_' . $row), $row, $request->kd_alat, $data->path_file);
                    }

                    $data->save();
                    DB::commit();
                }
            }

            $flasher->addSuccess('Data has been saved successfully!');
        } catch(Exception $e) {
            DB::rollback();
            $flasher->addError('An error has occurred please try again later.');
        }

        return redirect()->route('ikdocument.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IkDocument  $ikDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, FlasherInterface $flasher)
    {
        DB::beginTransaction();

        try {               
            $data = IkDocumentRepository::getDocByCodeAll($request->id);

            foreach ($data as $row) {
                if ( Storage::disk('local')->exists($row->path_file) ) {
                    Storage::disk('local')->delete($row->path_file);
                }
            }
            
            IkDocumentRepository::deleteByCode($request->id);
            DB::commit();

            return response()->json(['result' => 'success'])->setStatusCode(200, 'OK');
        } catch(Exception $e) {
            DB::rollback();
            return response()->json(['result' => $e->getMessage()])->setStatusCode(500, 'ERROR');
        }
    }
}
