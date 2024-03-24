<?php

namespace App\Repositories;

use App\Models\Condition;
use App\Models\Category;
use App\Models\Location;
use App\Models\Pic;

class SelectRepository
{
	
	public static function kondisi()
	{
		$kondisi = Condition::get()->pluck('kondisi', 'kd_kondisi')->toArray();
		$labelKondisi = ["" => "- Choose Status -"];
		$kondisi = $labelKondisi + $kondisi;

		return $kondisi;
	}

	public static function lokasi()
	{
		$lokasi = Location::get()->pluck('ket', 'kd_lokasi')->toArray();
		$labelLokasi = ["" => "- Choose Location -"];
		$lokasi = $labelLokasi + $lokasi;

		return $lokasi;
	}

	public static function groupCode()
	{
		$category = Category::select('kd_alat', 'ket')
			->whereNotIn('kd_alat', function($query){
				$query->select('kd_alat')
					->from('iris_ik_documents');
			})
			->get(['kd_alat'])
			->pluck('ket', 'kd_alat')
			->toArray();
		$labelCategory = ["" => "- Choose Code -"];
		$category = $labelCategory + $category;

		return $category;
	}

	public static function category()
	{
		$category = Category::get()->pluck('ket', 'kd_alat')->toArray();
		$labelCategory = ["" => "- Choose Kode Alat -"];
		$category = $labelCategory + $category;

		return $category;
	}

	public static function categoryIkDoc()
	{
		$category = Category::whereNotIn('kd_alat', function($query){
				$query->select('kd_alat')
					->from('iris_ik_documents');
			})
			->get()->pluck('ket', 'kd_alat')
			->toArray();
		$labelCategory = ["" => "- Choose Kode Alat -"];
		$category = $labelCategory + $category;

		return $category;
	}

	public static function picFullName()
	{
		$data = Pic::take(100)->get();
		$options = ["" => "- Choose PIC -"];

		foreach ($data as $row) {
			$options[$row->employee_id] = $row->full_name;
		}

		return $options;
	}
}