<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Type extends Model
{
    use Filterable;
    use HasFactory;
    use HybridRelations;

    protected $collection = "types";
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}