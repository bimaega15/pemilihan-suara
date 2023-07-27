<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpsDetail extends Model
{
    use HasFactory;
    protected $table = 'tps_detail';
    protected $guarded = ['id'];
}
