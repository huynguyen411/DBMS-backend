<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Filterable;
    use HasFactory;

    protected $table = "types";
    protected $primaryKey = 'type_id';
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Book::class, 'type_id', 'type_id');
    }
}
