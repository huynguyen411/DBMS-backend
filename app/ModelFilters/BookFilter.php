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
        return $this->where('book_id', $bookId);
    }

    public function nameBook($name_book)
    {
        return $this->where('name_book', 'LIKE', "%$name_book%");
    }

    public function typeId($type_id)
    {
        $arrTypeId = $this->filterByType($type_id);

        return $this->whereIn('type_id', $arrTypeId);
    }

    public function nameType($name_type)
    {
        return $this->related('type', 'name', 'like', "%$name_type%");
    }

    public function author($author)
    {
        return $this->where('author', 'like', "%$author%");
    }

    public function translator($translator)
    {
        return $this->where('translator', 'like', "%$translator%");
    }

    public function isbn($isbn)
    {
        return $this->where('isbn', "like", "%$isbn%");
    }


    public function price($price)
    {
        if (is_array($price)) {
            return $this->where([['price', '>', $price[0]], ['price', '<', $price[1]]]);
        }

        return $this->where('price', $price);
    }

    public function publishingYear($publishing_year)
    {
        return $this->whereYear('publication_date', $publishing_year);
    }

    public function countryName($countryName)
    {
        return $this->related('country', 'country_name', 'like', "%$countryName%");
    }

    public function countryId($countryId)
    {
        return $this->related('country', 'country_id', $countryId);
    }

    public function codeDDC($codeDDC)
    {
        $type = Type::where('code', $codeDDC)->first();
        return $this->typeId($type->type_id);
    }
    protected function filterByType($type_id)
    {
        $Type = Type::where('type_id', $type_id)->first();
        $types = Type::all();
        $queue = [];
        $arr = [];
        array_push($arr, $Type);
        array_push($queue, $Type);
        while ($queue != null) {
            $Type = array_shift($queue);
            foreach ($types as $type) {
                if ($type->parent_id == $Type->type_id) {
                    array_push($queue, $type);;
                    array_push($arr, $type);
                }
            }
        }
        $result = [];
        foreach ($arr as $element) {
            if ($element->level == 3) {
                array_push($result, $element->type_id);
            }
        }
        return $result;
    }
}
