<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TypeFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    protected $drop_id = false;
    public function typeId($typeId){
        return $this->where('type_id', $typeId);
    }
    public function code($code){
        return $this->where('code', $code);
    }
    public function name($name){
        return $this->where('name', 'LIKE', "%$name%");
    }
    public function parentId($parentId){
        return $this->where('parent_id', $parentId);
    }
    public function level($level){
        return $this->where('level', $level);
    }
    
}