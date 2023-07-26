<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanKuisioner extends Model
{
    use HasFactory;
    protected $table = 'jawaban_kuisioner';
    protected $guarded = ['id'];

    public function pernyataan()
    {
        return $this->hasMany(PernyataanDetail::class, 'jawaban_kuisioner_id', 'id');
    }
}
