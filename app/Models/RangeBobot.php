<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangeBobot extends Model
{
    use HasFactory;
    protected $table = 'range_bobot';
    protected $guarded = ['id'];

    public function pernyataanDetail()
    {
        return $this->hasMany(PernyataanDetail::class, 'range_bobot_id', 'id');
    }
}
