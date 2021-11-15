<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
    public function userId($id)
    {
        return $this->where('_id', $id);
    }

    public function name($name)
    {
        return $this->whereLike('name', "%$name%");
    }


    public function address($address)
    {
        return $this->whereLike('address', 'like', "%$address%");
    }

    public function email($email)
    {
        return $this->whereLike('email', "%$email%");
    }

    public function role($roleId)
    {
        return $this->where('role_id', $roleId);
    }
    
    public function createdAt($createdAt)
    {
        return $this->whereBetween('created_at', [$createdAt[0], $createdAt[1]]);
    }
}