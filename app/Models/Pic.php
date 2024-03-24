<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    use HasFactory;

    protected $table = 'hrms.personal';
    protected $primaryKey = 'employee_id';
    protected $keyType = 'string';
    protected $visible = ['employee_id', 'first_name', 'last_name', 'full_name'];
    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        $full = collect([$this->first_title, $this->first_name, $this->last_name, $this->last_title])->reject(function ($value, $key) {
            return is_null($value);
        });
        return implode(' ', $full->all());
    }

    public function getPenggunaAttribute()
    { 
      return "{$this->employee_id} - {$this->first_name} {$this->last_name}";
    }
}
