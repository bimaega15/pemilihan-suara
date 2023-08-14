<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpsPendukung extends Model
{
    use HasFactory;
    protected $table = 'tps_pendukung';
    protected $guarded = [];

    public function tpsDetail()
    {
        return $this->belongsTo(TpsDetail::class);
    }

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
