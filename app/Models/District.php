<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function regencies()
    {
        return $this->belongsTo(Regencies::class, 'regency_id', 'id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id', 'id');
    }

    public function tps()
    {
        return $this->hasMany(Tps::class, 'districts_id', 'id');
    }
}
