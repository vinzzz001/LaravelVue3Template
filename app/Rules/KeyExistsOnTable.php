<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

/**
 * Test if an cetain $value exists on a specified $column in $table
 */
class KeyExistsOnTable implements ValidationRule
{
    protected $table;
    protected $column;
    protected $value;


    /**
     * Constructor
     *
     * @param [string] $table
     * @param [string] $column
     * @param [any]    $value
     */
    public function __construct($table, $column, $value)
    {
        $this->table = $table;
        $this->column = $column;
        $this->value = $value;
    }



    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail ): void
    {
        if (DB::table($this->table)->where($this->column, $value)->doesntExist()) {
            return;
        }

        $fail($this->message()); //Dunno if this is correct.
    }

    /**
     * A standard fail message on failed validation.
     *
     * @return error string
     */
    public function message()
    {
        return 'The selected :attribute is used as a foreign key in :table';
    }

}
