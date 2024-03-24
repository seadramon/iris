<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pat;
use App\Models\Inventory;
use App\Models\Category;

use App\Exports\InventoryExport;
use App\Exports\RekapInventory;
use App\Exports\AgeExport;
use App\Models\TrMaterial;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function inventory()
    {
        $query = Pat::select('ket', DB::raw("concat( concat( kd_pat, '#' ), ket ) as kdket"));
        $pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('kd_pat', $pat);
		}
    	$data = $query->get()
            ->pluck('ket', 'kdket')
            ->toArray();
    	$labelPat = ["" => "- Pilih PAT -"];
    	$data = $labelPat + $data;

    	$sumber = ['' => "-	Pilih Sumber -",
    		'intra' => 'Intra',
    		'ekstra' => 'Ekstra'
    	];

    	return view('pages.form-report.inventory', [
    		'pat' => $data,
    		'sumber' => $sumber
    	]);
    }

    public function inventoryExport(Request $request)
    {
    	$sumber = !empty($request->sumber)?$request->sumber:"";
    	$pat = !empty($request->kd_pat)?$request->kd_pat:"";
        $ket = "";

        if (!empty($pat)) {
            $tmp = explode("#", $pat);
            $pat = $tmp[0];
            $ket = $tmp[1];
        }

        return Excel::download(new InventoryExport($sumber, $pat, $ket), 'inventory.xlsx');
    }

    public function age()
    {
        $query = Pat::select('ket', DB::raw("concat( concat( kd_pat, '#' ), ket ) as kdket"));
        $pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('kd_pat', $pat);
		}
    	$data = $query->get()
            ->pluck('ket', 'kdket')
            ->toArray();
    	$labelPat = ["" => "- Pilih PAT -"];
    	$data = $labelPat + $data;

        return view('pages.form-report.age', [
            'pat' => $data
        ]);
    }

    public function ageExport(Request $request)
    {
        $period = !empty($request->period)?$request->period:"";
        $pat = !empty($request->kd_pat)?$request->kd_pat:"";
        $ket = "";

        $period = date("Y-m", strtotime($period));
        $tmpPeriod = explode("-", $period);
        $year = $tmpPeriod[0];
        $month = getMonth($tmpPeriod[1]);

        if (!empty($pat)) {
            $tmp = explode("#", $pat);
            $pat = $tmp[0];
            $ket = $tmp[1];
        }

        return Excel::download(new AgeExport($year, $month, $pat, $ket), 'age.xlsx');
    }

    public function qrcode()
    {
        $query = Pat::select('ket', DB::raw("concat( concat( kd_pat, '#' ), ket ) as kdket"));
        $pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('kd_pat', $pat);
		}
    	$data = $query->get()
            ->pluck('ket', 'kdket')
            ->toArray();
    	$labelPat = ["" => "- Pilih PAT -"];
    	$data = $labelPat + $data;

        $alat = Category::select('ket', 'kd_alat')
            ->get()
            ->pluck('ket', 'kd_alat')
            ->toArray();
        $labelAlat = ["" => "- Pilih Alat -"];
        $alat = $labelAlat + $alat;

        return view('pages.form-report.qrcode', [
            'pat' => $data,
            'alat' => $alat
        ]);
    }

    public function qrcodePdf(Request $request)
    {
        $pat = !empty($request->kd_pat)?$request->kd_pat:"";
        $ket = "";

        $query = Inventory::select('*');

        if (!empty($pat)) {
            $tmp = explode("#", $pat);
            $pat = $tmp[0];
            $ket = $tmp[1];

            $query->where('pat_alat', $pat);
        }

        if (!empty($request->kd_alat)) {
            $query->where('kd_alat', $request->kd_alat);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('exports.qrcode', [
            'data' => $data,
            'ket' => $ket
        ]);

        $filename = !empty($ket)?$ket:"QrCode-list";

        return $pdf->setPaper('a4', 'portrait')
            ->stream($filename . '.pdf');
    }

    public function qrcodeSukucadang()
    {
        return view('pages.form-report.qrcode-sukucadang', []);
    }

    public function qrcodeSukucadangPdf(Request $request)
    {
        $data = TrMaterial::where('kd_jmaterial', 'S')->where('kd_material', 'like', $request->prefix . '%')->get();

        $pdf = Pdf::loadView('exports.qrcode-sukucadang', [
            'data' => $data
        ]);

        $filename = "QrCode-sukucadang-list";

        return $pdf->setPaper('a4', 'portrait')
            ->stream($filename . '.pdf');
    }

    public function rekapInventory()
    {
        $query = Pat::select('ket', DB::raw("concat( concat( kd_pat, '#' ), ket ) as kdket"));
        $pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('kd_pat', $pat);
		}
    	$data = $query->get()
            ->pluck('ket', 'kdket')
            ->toArray();
    	$labelPat = ["" => "- Pilih PAT -"];
    	$data = $labelPat + $data;

        return view('pages.form-report.rekap-inventory', [
            'pat' => $data
        ]);
    }

    public function rekapInventoryExport(Request $request)
    {
        $pat = !empty($request->kd_pat)?$request->kd_pat:"";
        $ket = "";

        if (!empty($pat)) {
            $tmp = explode("#", $pat);
            $pat = $tmp[0];
            $ket = $tmp[1];
        }

        return Excel::download(new RekapInventory($pat, $ket), 'rekap-inventory.xlsx');
    }
}
