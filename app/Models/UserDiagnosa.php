<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiagnosa extends Model
{
    use HasFactory;
    protected $table = 'user_diagnosa';
    protected $guarded = ['id'];

    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'user_diagnosa_id', 'id');
    }
}
