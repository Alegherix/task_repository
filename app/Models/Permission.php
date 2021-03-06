<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Many-to-many relationship
    // A permission has many roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions'); // specified
    }
}
