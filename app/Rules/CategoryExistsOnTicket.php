<?php

namespace App\Rules;

/**
 * Test if an cetain $value exists on a specified $column in $table
 */
class CategoryExistsOnTicket extends KeyExistsOnTable
{

    public function __construct($value)
    {
        $this->table = 'tickets';
        $this->column = 'category_id';
        $this->value = $value;
    }

    /**
     * A specific fail message on failed validation.
     *
     * @return error string
     */
    public function message()
    {
        return 'This category is currently in attached to a ticket';
    }

}
