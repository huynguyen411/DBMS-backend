<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageBook extends Model
{
    use HasFactory;
    protected $fillable = ['language_id', 'book_id'];


    public function language()
    {
        return $this->belongsTo(Languages::class, 'language_id', 'language_id');
    }
}
