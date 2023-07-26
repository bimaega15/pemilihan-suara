<?php

namespace App\Models;

use App\Models\Pernyataan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PernyataanDetail extends Model
{
    use HasFactory;
    protected $table = 'pernyataan_detail';
    protected $guarded = ['id'];

    public function kuisioner()
    {
        return $this->belongsTo(Kuisioner::class, 'kuisioner_id', 'id', 'kuisioner');
    }
    public function jawabanKuisioner()
    {
        return $this->belongsTo(JawabanKuisioner::class, 'jawaban_kuisioner_id', 'id', 'jawaban_kuisioner');
    }
    public function pernyataan()
    {
        return $this->belongsTo(Pernyataan::class, 'pernyataan_id', 'id', 'pernyataan');
    }
}
