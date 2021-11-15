<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class RentalFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    protected $drop_id = false;
    public function rentalId($rentalId){
        return $this->where('_id', $rentalId);
    }

    public function bookId($bookId){
        return $this->where('book_id', $bookId);
    }

    public function userId($userId){
        return $this->where('user_id', $userId);
    }

    public function rentalDate($rentalDate){
        return $this->where('rental_date', $rentalDate);
    }

    public function returnDate($returnDate){
        return $this->where('return_date', $returnDate);
    }

    public function promissoryDate($promissoryDate){
        return $this->where('promissory_date', $promissoryDate);
    }

    public function bookName($bookName){
        return $this->related('book', 'name', 'like', "%$bookName%");
    }

    public function userName($userName)
    {
        return $this->related('user', 'name', 'like', "%$userName%");
    }
}