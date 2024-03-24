<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iris_checklists';

    public function detail()
    {
    	return $this->hasMany(ChecklistDetail::class, 'checklist_id', 'id');
    }

    public function personal()
    {
        return $this->belongsTo(Pic::class, 'created_by', 'employee_id');
    }
    
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'no_inventaris', 'no_inventaris');
    }

    public function assigns()
    {
    	return $this->belongsTo(CPerawatanAssign::class, 'assign_id', 'id');
    }
}
