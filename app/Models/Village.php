<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    protected $table = 'villages';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function tps()
    {
        return $this->hasMany(Tps::class, 'villages_id', 'id');
    }
}
