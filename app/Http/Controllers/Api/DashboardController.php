<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventory;
use App\Models\FPerbaikan;
use App\Models\Location;

use DB;

class DashboardController extends Controller
{
	public function ownership()
	{
		$query = Inventory::select(DB::raw("SUM
			(CASE
				WHEN no_inventaris LIKE '%E' THEN 1
				ELSE 0
				END
			) AS extra, SUM
			(CASE
				WHEN no_inventaris NOT LIKE '%E' THEN 1
				ELSE 0
				END
			) AS intra"));

		$pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('pat_alat', $pat);
		}
		$data = $query->first();

		$ownership = (object)[
			"type" => "pie2d",
			"width"=> "100%",
			"height"=> "100%",
			"dataFormat"=> "json",
			"dataSource" => [
				"chart" => [
					"caption"=> "Ownership",
					"showlegend"=> "1",
					"legendposition"=> "bottom",
					"usedataplotcolorforlabels"=> "1",
					"theme"=> "fusion"
				],
				"data" => [
					["label"=> "Extra",
					"value"=> $data->extra],
					["label"=> "Intra",
					"value"=> $data->intra]
				]
			]
		];

		return response()->json($ownership)->setStatusCode(200, 'OK');
	}

	public function age()
	{
		$curDate = date('Y');

		$query = Inventory::select('th_perolehan');
		$pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('pat_alat', $pat);
		}
		$data = $query->get();
		$a = '0';
		$b = '0';
		$c = '0';
		foreach ($data as $row) {
			if (!empty($row->th_perolehan)) {
				if (is_numeric($row->th_perolehan)) {
					$range = date('Y') - $row->th_perolehan;
					switch (true) {
						case ($range < 5 ):
							$a++;
							break;
						case ($range >= 6 && $range <= 10):
							$b++;
							break;
						case ($range > 10):
							$c++;
							break;
					}
				}
			}
		}

		$ages = (object)[
			"type" => "pie2d",
			"width"=> "100%",
			"height"=> "100%",
			"dataFormat"=> "json",
			"dataSource" => [
				"chart" => [
					"caption"=> "Asset Age",
					"showPercentInTooltip"=> "0",
					"decimals"=> "1",
					"useDataPlotColorForLabels"=> "1",
					"theme"=> "fusion"
				],
				"data" => [
					["label"=> "< 5 Yr",
					"value"=> $a],
					["label"=> "6 - 10 Yr",
					"value"=> $b],
					["label"=> "> 10 Yr",
					"value"=> $c]
				]
			]
		];

		return response()->json($ages)->setStatusCode(200, 'OK');
	}

	public function condition()
	{
		$query = Inventory::select('tb_kondisi.kondisi', DB::raw("COUNT(alat.no_inventaris) as jml"))
			->join('tb_kondisi', 'alat.kondisi', '=', 'tb_kondisi.kd_kondisi')
			->groupBy('tb_kondisi.kondisi');

		$pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('pat_alat', $pat);
		}
		$data = $query->get();

		$arrData = [];
		if (count($data) > 0) {
			foreach ($data as $row) {
				$arrData[] = [
					"label" => $row->kondisi,
					"value" => $row->jml,
				];
			}
		}

		$condition = (object)[
			"type" => "pie2d",
			"width"=> "100%",
			"height"=> "100%",
			"dataFormat"=> "json",
			"dataSource" => [
				"chart" => [
					"caption"=> "Asset Condition",
					"showPercentInTooltip"=> "0",
					"decimals"=> "1",
					"useDataPlotColorForLabels"=> "1",
					"theme"=> "fusion"
				],
				"data" => $arrData
			]
		];

		return response()->json($condition)->setStatusCode(200, 'OK');
	}

	public function damageLocation(Request $request)
	{
		$arrDate = explode("-", str_replace(" ", "", $request->daterange));
		$start = date("d-m-Y", strtotime($arrDate[0]));
		$end = date("d-m-Y", strtotime($arrDate[1]));

		$location = Location::get();
// DB::enableQueryLog();
		$query = FPerbaikan::select(DB::raw("COUNT(IRIS_F_PERBAIKANS.no_inventaris) AS jml"), 'alat.KD_LOKASI', 'tb_lokasi.KET', DB::raw("TO_CHAR(IRIS_f_perbaikans.CREATED_AT, 'DD-MM-YYYY') AS tgl"))
		->join('alat', 'iris_f_perbaikans.no_inventaris', '=', 'alat.no_inventaris')
		->leftJoin('tb_lokasi', 'alat.kd_lokasi', '=', 'tb_lokasi.kd_lokasi')
		->groupBy('alat.kd_lokasi', 'tb_lokasi.ket', 'iris_f_perbaikans.created_at');

		if (!empty($request->daterange)) {
			$query->whereBetween("iris_f_perbaikans.created_at", [DB::raw("TO_DATE('$start', 'DD-MM-YYYY')"), DB::raw("TO_DATE('$end', 'DD-MM-YYYY')")]);
		}
		$pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('alat.pat_alat', $pat);
		}


		$arrData = $query->get();
		// dd($arrData);
// dd(DB::getQueryLog());
		$date = [];
		$seriesname = [];
		$data = [];
		$tmp= [];
		if (count($arrData) > 0) {
			foreach ($arrData as $row) {
				$date[] = ["label" => $row->tgl];
				$tmpDate[] = $row->tgl;

				foreach ($location as $loc) {
					if (!isset($data[$loc->kd_lokasi]['seriesname'])) {
						$data[$loc->kd_lokasi]['seriesname'] = $loc->ket;
					}

					if ($loc->kd_lokasi == $row->kd_lokasi) {
						$data[$loc->kd_lokasi]['data'][] = ["value" => $row->jml];
					} else {
						$data[$loc->kd_lokasi]['data'][] = ["value" => 0];
					}

				}
			}

			$tmp = [];
			foreach ($data as $foo) {
				$tmp[] = $foo;
			}
		}
// dd($tmp);
		$condition = (object)[
			"type" => "mscolumn2d",
			"width"=> "100%",
			"height"=> "100%",
			"dataFormat"=> "json",
			"dataSource" => [
				"chart" => [
					"caption"=> "Damage By Location",
					"subcaption"=> "daterange",
					"xaxisname"=> "Date",
					"yaxisname"=> "Total Perbaikan",
					"formatnumberscale"=> "1",
					"plottooltext"=>"",
					"theme"=> "fusion",
					"drawcrossline"=> "1"
				],
				"categories" => [[
									"category" => $date
								]],
				"dataset" => $tmp
			]
		];

		return response()->json(['data' => $condition, 'result' => 'success'])->setStatusCode(200, 'OK');
	}
}
