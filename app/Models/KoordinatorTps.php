<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoordinatorTps extends Model
{
    use HasFactory;
    protected $table = 'koordinator_tps';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
}
