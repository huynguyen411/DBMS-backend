<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use EloquentFilter\Filterable;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model 
{
    use HasFactory, Filterable;
    protected $collection = 'books';
    protected $fillable = ['name', 'author', 'publication_year', 'country_id', 'type_id', 'description', 'book_image', 'publisher'];
    
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}