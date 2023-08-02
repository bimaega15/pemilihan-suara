<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    use HasFactory;
    protected $table = 'regencies';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function district()
    {
        return $this->hasMany(District::class, 'regency_id', 'id');
    }

    public function tps()
    {
        return $this->hasMany(Tps::class, 'regencies_id', 'id');
    }
}
