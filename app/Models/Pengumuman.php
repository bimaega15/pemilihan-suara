<?php

namespace App\Models;

use App\Models\Pernyataan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'pengumuman';
    protected $guarded = ['id'];

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
}
