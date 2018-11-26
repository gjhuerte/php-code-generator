<?php

namespace Auxilliary\Generator\Interfaces;

interface Code
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