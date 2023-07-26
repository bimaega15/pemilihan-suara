<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pernyataan extends Model
{
    use HasFactory;
    protected $table = 'pernyataan';
    protected $guarded = ['id'];

    public function pernyataanDetail()
    {
        return $this->hasMany(PernyataanDetail::class, 'pernyataan_id', 'id');
    }

    public function rangeBobot()
    {
        return $this->belongsTo(RangeBobot::class, 'range_bobot_id', 'id');
    }
}
