<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class DepartmentFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    //protected $blacklist = ['secretMethod'];
    public $relations = [];
    protected $drop_id = false;
    public function departmentId($departmentId){
        return $this->where('department_id', $departmentId);
        //return $this->input();
    }
    
    public function departmentName($departmentName){
        return $this->where('department_name', 'LIKE', "$departmentName%");
        //return $this->input();
    }
   // protected $drop_id = false;
}