<?php

namespace App\Repositories;

use App\Models\Inventory;
use App\Models\InventoryDetail;

class InventoryRepository
{

	public static function getAllAset()
	{
		return Inventory::all();
	}

	public static function getData()
	{
        $query = Inventory::with(['category', 'brand', 'condition', 'location', 'functional', 'pic_last_updated', 'pic_created']);
        $pat = session('TMP_KDWIL');
		if($pat != '0A'){
			$query->where('pat_alat', $pat);
		}
		return $query;
	}

	public static function getAsetById($asetId)
	{
		return Inventory::with([
			'detail',
			'category',
			'brand',
			'condition',
			'location',
			'functional',
			'pic_last_updated',
			'ik_pengoperasian',
			'ik_perawatan',
			'ik_perbaikan',
		])->findOrFail($asetId);
	}

	public static function getDetailById($noInventaris)
	{
		return InventoryDetail::firstOrNew([
            'no_inventaris' => $noInventaris
        ]);
	}
}
