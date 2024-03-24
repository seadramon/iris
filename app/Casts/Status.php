<?php
 
namespace App\Casts;
 
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

class Status implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        switch ($value) {
            case 'operator':
                $status = 'Approved By Operator';
                break;
            case 'teknisi':
                $status = 'Technician Finished';
                break;
            case 'baru':
                $status = 'New';
                break;
            default:
                $status = Str::of($this->status)->studly();
                break;
        }
        return $status;
    }
 
    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}