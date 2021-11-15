<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $collection = "roles";
    public function users()
    {
        return $this->hasMany(User::class);
    }
}