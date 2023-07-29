<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $guarded = ['id'];

    public function regencies()
    {
        return $this->hasMany(Regencies::class, 'province_id', 'id');
    }
}