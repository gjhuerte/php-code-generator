<?php

namespace Auxilliary\Generator;

use Auxilliary\Generator\Interfaces\Code as CodeGenerator;

class Code implements CodeGenerator
{

    public const DASH_SEPARATOR = '-';
    public const COMMA_SEPARATOR = ',';

    /**
     * Concatenate the values from the given attribute
     *
     * @param string $delimiter
     * @param array $args
     * @return string
     */
    public static function make(array $args, string $delimiter = null)
    {
        if (! isset($delimiter)) {
            $delimiter = self::DASH_SEPARATOR;
        }

        return implode($delimiter, $args);
    }
}