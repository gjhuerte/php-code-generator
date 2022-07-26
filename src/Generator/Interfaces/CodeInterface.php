<?php

namespace Aux\Generator\Interfaces;

interface CodeInterface
{
    /**
     * Generates a random string based on the length given
     *
     * @param int $length
     * @return String
     */
    public function setGenerateAttribute($length);

    /**
     * Sets the format of the string to be generated
     *
     * @param String $string
     * @return mixed
     */
    public function setFormatAttribute($string);

    /**
     * Accepts a function and should return true if the value is unique  
     *
     * @param Function $callback
     * @return mixed
     */
    public function setUniqueAttribute($callback);

    /**
     * Specifies the characters to be included in the random generator
     *
     * @param String $characters
     * @return mixed
     */
    public function setExcludeAttribute($characters);

    /**
     * Specifies the characters to be included in the random generator
     *
     * @param String $characters
     * @return mixed
     */
    public function setIncludeAttribute($character);
}