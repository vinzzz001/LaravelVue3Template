<?php

namespace App\Rules;

/**
 * Test if an cetain $value exists on a specified $column in $table
 */
class EmailExistsOnUser extends KeyDoesNotExistOnTable
{

    public function __construct($value)
    {
        $this->table = 'users';
        $this->column = 'email';
        $this->value = $value;
    }

    /**
     * A specific fail message on failed validation.
     *
     * @return error string
     */
    public function message()
    {
        return 'This email is not in use';
    }

}
