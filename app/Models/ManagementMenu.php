<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementMenu extends Model
{
    use HasFactory;
    protected $table = 'management_menu';
    protected $guarded = ['id'];

    public function managementMenuRoles()
    {
        return $this->hasMany(ManagementMenuRoles::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
