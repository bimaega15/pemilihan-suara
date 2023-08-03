<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpsDetail extends Model
{
    use HasFactory;
    protected $table = 'tps_detail';
    protected $guarded = ['id'];

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
