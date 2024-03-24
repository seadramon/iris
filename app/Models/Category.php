<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table      = 'tb_alat';
    protected $primaryKey = 'kd_alat';
    protected $keyType    = 'string';
    protected $visible    = ['kd_alat', 'ket', 'form_list', 'ik_document_count'];
    protected $appends    = ['form_list'];

    public $timestamps = false;

    public function getFormListAttribute()
    {
        $forms = ['perbaikan', 'perawatan', 'checklist_perawatan', 'suhu_trafo', 'mixer_bp'];
        if(in_array($this->kd_alat, ['D0JZ', 'D0KC']) || in_array(substr($this->kd_alat, 0, 3), ['D0A', 'D0F'])){
            $forms[] = 'sling';
        }
        if(in_array($this->kd_alat, ['D0FW', 'D0KC'])){
            $forms[] = 'rantai_angkat';
        }
        $forms[] = 'evaluasi_kehandalan';
        return $forms;
    }

    public function ik_document()
    {
    	return $this->hasMany(IkDocument::class, 'kd_alat', 'kd_alat');
    }
}
