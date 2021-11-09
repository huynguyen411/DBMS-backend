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

    public function countryName($country_name)
    {
        $this->whereLike('country_name', $country_name);
    }

    public function countryId($country_id)
    {
        $this->where('country_id', $country_id);
    }
  

}
