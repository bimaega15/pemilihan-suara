<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'roles';

    public function managementMenuRoles()
    {
        return $this->hasMany(ManagementMenuRoles::class);
    }

    public function managementMenu()
    {
        return $this->belongsToMany(ManagementMenu::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
