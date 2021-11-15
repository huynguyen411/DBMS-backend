<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use EloquentFilter\Filterable;

class Country extends Model
{
    use HasFactory, Filterable;
    
    protected $collection = "countries";
    protected $fillable = ['_id', 'country_name'];


    public function book()
    {
        return $this->hasOne(Book::class);
    }
}   