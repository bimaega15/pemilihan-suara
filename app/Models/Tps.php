<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $table = 'tps';
    protected $guarded = ['id'];

    public function tpsDetail()
    {
        return $this->hasMany(TpsDetail::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'provinces_id', 'id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class, 'regencies_id', 'id');
    }

    public function districts()
    {
        return $this->belongsTo(District::class, 'districts_id', 'id');
    }

    public function villages()
    {
        return $this->belongsTo(Village::class, 'villages_id', 'id');
    }

    public function tpsPendukung()
    {
        return $this->hasMany(TpsPendukung::class);
    }

    public function koordinatorTps()
    {
        return $this->hasMany(KoordinatorTps::class);
    }
}
