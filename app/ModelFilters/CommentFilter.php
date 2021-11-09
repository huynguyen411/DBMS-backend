<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CommentFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    protected $drop_id = false;

     public function commentId($commentId){
        return $this->where('comment_id', $commentId);
    }
    
    public function bookId($bookId){
        return $this->where('book_id', $bookId);
    }
    
    public function borrowerId($borrowerId){
        return $this->where('borrower_id', $borrowerId);
    }  

    public function rating($rating){
        return $this->where('rating', $rating);
    }   
}