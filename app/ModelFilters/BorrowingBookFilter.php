<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BorrowingBookFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    protected $drop_id = false;
    public function borrowingBookId($borrowing_book_id){
        return $this->where('borrowing_book_id', $borrowing_book_id);
    }

    public function bookId($book_id){
        return $this->where('book_id', $book_id);
    }

    public function borrowerId($borrower_id){
        return $this->where('borrower_id', $borrower_id);
    }

    public function fromDate($from_date){
        return $this->where('from_date', $from_date);
    }

    public function toDate($to_date){
        return $this->where('to_date', $to_date);
    }

    public function promissoryDate($promissory_date){
        return $this->where('promissory_date', $promissory_date);
    }

    public function statusId($status_id){
        return $this->where('status_id', $status_id);
    }

    public function nameBook($name_book){
        return $this->related('book', 'name_book', 'like', "%$name_book%");
    }

    // (array_meger($request->except('type_id'), ['type_id' => $typeIds]))

}


