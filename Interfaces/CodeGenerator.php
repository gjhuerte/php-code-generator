<?php

namespace App\Http\Modules\Generator\Interfaces;

interface CodeGenerator
{

    /**
     * Concatenate the values from the given attribute
     *
     * @param string $delimiter
     * @param array $args
     * @return string
     */
    public static function make(array $args, string $delimiter);
}