<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingStatus extends Model
{

    use HasFactory;
    protected $table = "borrowing_status";
    protected $primaryKey = 'borrowing_status_id';
    public $timestamps = false;
}
