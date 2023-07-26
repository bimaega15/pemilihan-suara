<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDetail extends Model
{
    use HasFactory;
    protected $table = 'hasil_detail';
    protected $guarded = ['id'];

    public function hasil()
    {
        return $this->belongsTo(Hasil::class, 'hasil_id', 'id');
    }
    public function kuisioner()
    {
        return $this->belongsTo(Kuisioner::class, 'kuisioner_id', 'id');
    }
    public function jawabanKuisioner()
    {
        return $this->belongsTo(JawabanKuisioner::class, 'jawaban_kuisioner_id', 'id');
    }
}
