<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendukungTps extends Model
{
    use HasFactory;
    protected $table = 'pendukung_tps';
    protected $guarded = ['id'];

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
