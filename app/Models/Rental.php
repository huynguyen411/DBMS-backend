<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Rental extends Model
{
    use Filterable;
    use HasFactory;
    protected $collection = 'rentals';
    protected $fillable = ['book_id', 'borrower_id', 'from_date', 'to_date', 'promissory_date','status_id'];
    public $timestamps = false;


    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

}