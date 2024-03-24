<?php

namespace App\Repositories;

use App\Models\IkDocument;
use App\Models\Category;

class IkDocumentRepository
{
	
	public static function getAllDocument()
	{
		return IkDocument::all();
	}

	public static function getData()
	{
		return IkDocument::select('*');
	}

	public static function getDocById($documentId)
	{
		return IkDocument::findOrFail($documentId)->with(['category']);
	}

	public static function getDocByCode($code, $category = null)
	{
		$data = IkDocument::where('kd_alat', $code);

		if (!empty($category)) {
			$data->where('category', $category);
		}

		return $data->first();
	}

	public static function getDocByCodeAll($code, $category = null)
	{
		$data = IkDocument::where('kd_alat', $code);

		if (!empty($category)) {
			$data->where('category', $category);
		}

		return $data->get();
	}

	public static function getFromAlat()
	{
		// dd(Category::withCount('ik_document')->has('ik_document')->get());
		return Category::withCount('ik_document')->has('ik_document');
	}

	public static function deleteByCode($code)
	{
		return IkDocument::where('kd_alat', $code)->delete();
	}

	public function create(array $documentDetails)
	{

	}

	public function update($asetId, array $asetDetails)
	{

	}
}