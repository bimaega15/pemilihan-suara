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
}
