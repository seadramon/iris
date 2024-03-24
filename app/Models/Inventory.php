<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'no_inventaris';
    protected $keyType = 'string';
    protected $appends = ['pic', 'nilai_status', 'nilai_kondisi', 'nilai_umur', 'nilai_daya'];

    const CREATED_AT = 'CREATED_DATE';
    const UPDATED_AT = 'LAST_UPDATE_DATE';

    public function getPicAttribute()
    {
        $pic = $this->pic_last_updated ?? $this->pic_created;
        return $pic ? "{$pic->first_name} {$pic->last_name}" : "";
    }

    public function getNilaiUmurAttribute()
    {

        $umur = $this->calculate_umur($this->th_pembuatan);
        $range = DB::table('ref_umur_alat')->where('range_awal', '<=', $umur)->where('range_akhir', '>=', $umur)->first();
        return $range->nilai ?? 0;
    }

    public function getNilaiDayaAttribute()
    {
        $umur = $this->calculate_umur($this->th_pembuatan);
        $range = DB::table('ref_daya_alat')->where('range_awal', '<=', $umur)->where('range_akhir', '>=', $umur)->first();
        return $range->nilai ?? 0;
    }

    public function getNilaiKondisiAttribute()
    {
        $total = (($this->nilai_operasi ?? 0) * 0.3) + (($this->nilai_daya ?? 0) * 0.3) + (($this->nilai_umur ?? 0) * 0.1) + (($this->nilai_safety ?? 0) * 0.2) + (($this->nilai_lengkap ?? 0) * 0.1);
        return $total;
    }

    public function getNilaiStatusAttribute()
    {
        $range = DB::table('ref_status_alat')->where('range_awal', '>=', intval($this->nilai_kondisi))->where('range_akhir', '<=', intval($this->nilai_kondisi))->first();
        return $range->ket ?? 'aa';
    }

    public function category()
    {
    	return $this->belongsTo(Category::class, 'kd_alat', 'kd_alat');
    }

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'kd_merk', 'kd_merk');
    }

    public function location()
    {
    	return $this->belongsTo(Location::class, 'kd_lokasi', 'kd_lokasi');
    }

    public function functional()
    {
        return $this->belongsTo(Functional::class, 'kd_fungsi', 'kd_fungsi');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class, 'kondisi', 'kd_kondisi');
    }

    public function pic_last_updated()
    {
        return $this->belongsTo(Pic::class, 'last_update_by', 'employee_id');
    }

    public function pic_created()
    {
        return $this->belongsTo(Pic::class, 'created_by', 'employee_id');
    }

    public function ik_pengoperasian()
    {
        return $this->hasOne(IkDocument::class, 'kd_alat', 'kd_alat')->whereCategory('pengoperasian');
    }

    public function ik_perawatan()
    {
        return $this->hasOne(IkDocument::class, 'kd_alat', 'kd_alat')->whereCategory('perawatan');
    }

    public function ik_perbaikan()
    {
        return $this->hasOne(IkDocument::class, 'kd_alat', 'kd_alat')->whereCategory('perbaikan');
    }

    public function detail()
    {
        return $this->hasOne(InventoryDetail::class, 'no_inventaris', 'no_inventaris');
    }

    public function pat()
    {
        return $this->belongsTo(Pat::class, 'pat_alat', 'kd_pat');
    }
    
    private function calculate_umur($acuan)
    {
        return $this->th_pembuatan ? (intval(date('Y')) - intval($this->th_pembuatan)): 999;
    }
}
