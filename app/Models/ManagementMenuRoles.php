<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementMenuRoles extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'management_menu_roles';

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id', 'id');
    }
    public function managementMenu()
    {
        return $this->belongsTo(ManagementMenu::class);
    }
}
