<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use App\Models\Type;

class BookFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array 
     */
    public $relations = [];
    protected $drop_id = false;
    public function bookId($bookId)
    {
        return $this->where('_id', $bookId);
    }

    public function name($name)
    {
        return $this->where('name', 'LIKE', "%$name%");
    }

    public function typeId($typeId)
    {
        return $this->where('type_id', $typeId);
    }

    public function typeName($typeName)
    {
        return $this->related('type', 'name', 'like', "%$typeName%");
    }

    public function author($author)
    {
        return $this->where('author', 'like', "%$author%");
    }

    public function publicationYear($publicationYear)
    {
        return $this->whereYear('publication_year', $publicationYear);
    }

    public function countryName($countryName)
    {
        return $this->related('country', 'name', 'like', "%$countryName%");
    }

    public function countryId($countryId)
    {
        return $this->where('country_id', $countryId);
    }
}