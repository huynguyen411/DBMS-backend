<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use App\Models\Type;

class CountryFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array 
     */
    public $relations = [];
    protected $drop_id = false;

    public function name($country_name)
    {
        $this->whereLike('name', $country_name);
    }

    public function countryId($country_id)
    {
        $this->where('_id', $country_id);
    }
  

}