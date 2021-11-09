<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
    use HasFactory;
    protected $table = "book_contents";

    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
