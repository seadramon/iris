<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{
    use HasFactory;

    protected $table = 'iris_alat_details';
    protected $guarded = [];
    protected $visible = ['no_inventaris', 'sertifikat_no', 'sertifikat_tahun', 'sertifikat_url', 'foto1_url', 'foto2_url', 'foto3_url', 'foto4_url'];
    protected $appends = ['sertifikat_url', 'foto1_url', 'foto2_url', 'foto3_url', 'foto4_url'];

    public function getSertifikatUrlAttribute()
    {
        return full_url_from_path($this->sertifikat_path);
    }

    public function getFoto1UrlAttribute()
    {
        return full_url_from_path($this->foto1_path);
    }

    public function getFoto2UrlAttribute()
    {
        return full_url_from_path($this->foto2_path);
    }

    public function getFoto3UrlAttribute()
    {
        return full_url_from_path($this->foto3_path);
    }

    public function getFoto4UrlAttribute()
    {
        return full_url_from_path($this->foto4_path);
    }

    public function inventory()
    {
    	return $this->belongsTo(Inventory::class, 'no_inventaris', 'no_inventaris');
    }

}
