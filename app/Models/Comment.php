<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $primaryKey = 'comment_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'borrower_id', 'id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
