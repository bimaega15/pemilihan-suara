<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    use HasFactory;
    protected $table = 'kuisioner';
    protected $guarded = ['id'];

    public function pernyataanDetail()
    {
        return $this->hasMany(PernyataanDetail::class, 'kuisioner_id', 'id');
    }
    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'kuisioner_id', 'id');
    }
}
