<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Country extends Model
{
    use HasFactory, Filterable;
    
    protected $table = "countries";
    protected $primaryKey = 'country_id';
    protected $fillable = ['country_id', 'country_name'];


    public function book()
    {
        return $this->hasOne(Book::class, 'country_id', 'country_id');
    }
}
