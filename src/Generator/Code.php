<?php

namespace Aux\Generator;

use Aux\Generator\Interfaces\CodeInterface;

class Code implements CodeInterface
{
    /**
     * Format of the String to be generated
     *
     * @var String
     */
    public String $format = '';

    /**
     * Characters to be included in the generator
     *
     * @var String
     */
    public String $included = '';

    /**
     * Characters to be excluded from generator
     *
     * @var String
     */
    public String $excluded = '';

    /**
     * Validates if the String generated is unique
     *
     * @var Function
     */
    public $uniqueChecker = null;

    /**
     * Lower-cased letters 
     * 
     * @var String
     */
    const LOWERCASED_LETTERS = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * Upper-cased letters
     * 
     * @var String
     */
    const UPPERCASED_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Numbers
     * 
     * @var String
     */
    const NUMBERS = '1234567890';

    /**
     * Special characters
     * 
     * @var String
     */
    const SPECIAL_CHARACTERS = '!@#$%^&*';

    /**
     * Creating a both static and instance variable
     *
     * @param String $name
     * @param array $arguments
     * @return void
     */
    public function __call($name, $arguments)
    {
        $method = 'set' . ucfirst($name) . 'Attribute';

        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arguments);
        }
    }

    /**
     * Calling instance as static variable
     *
     * @param String $name
     * @param array $arguments
     * @return void
     */
    public static function __callStatic($name, $arguments)
    {
        $instance = new static();

        $method = 'set' . ucfirst($name) . 'Attribute';

        if (method_exists($instance, $method)) {
            return call_user_func_array([$instance, $method], $arguments);
        }
    }

    /**
     * Generates a random string without checker for unique
     *
     * @param int $length
     * @param String $overrideCharacters
     * @return String
     */
    public function setGeneratorAttribute($length, $overrideCharacters = null)
    {
        $characters = $overrideCharacters;

        // Checks if theres no overriding of characters
        if (! $overrideCharacters) {
            $characters = implode('', [
                self::LOWERCASED_LETTERS,
                self::UPPERCASED_LETTERS,
                self::NUMBERS,
                self::SPECIAL_CHARACTERS,
                $this->included,
            ]);
    
            // Removed excluded characters from the string to be generated 
            if (strlen($this->excluded) > 0) {
                $characters = str_replace(str_split($this->excluded), '', $characters);
            }
        }

        $charactersLength = strlen($characters);
        $randomString = '';

        // Loops through each item
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }

    /**
     * Generates a formatted random string without checker for unique
     * 
     * u - upper-cased
     * l - lower-cased
     * r - random-cased
     * n - numeric-cased
     * s - special-characters
     * a - any characters
     *
     * @param String $format
     * @return String
     */
    public function setFormattedGeneratorAttribute($format)
    {
        $randomString = '';
        $formatCharacters = str_split($format);

        foreach ($formatCharacters as $_formatCharacter) {
            switch ($_formatCharacter) {
                case 'u':
                    $randomString .= $this->generator(1, self::UPPERCASED_LETTERS);

                    break;
                case 'l':
                    $randomString .= $this->generator(1, self::LOWERCASED_LETTERS);

                    break;
                case 'n':
                    $randomString .= $this->generator(1, self::NUMBERS);

                    break;
                case 'r':
                    $randomString .= $this->generator(1, implode('', [self::UPPERCASED_LETTERS, self::LOWERCASED_LETTERS]));

                    break;

                    break;
                case 's':
                    $randomString .= $this->generator(1, self::SPECIAL_CHARACTERS);

                case 'a':
                    $randomString .= $this->generator(1);

                    break;
                default:
                    $randomString .= $_formatCharacter;

                    break;
            }
        }

        return $randomString;
    }

    /**
     * Generates a random string based on the length given
     *
     * @param int $length
     * @return String
     */
    public function setGenerateAttribute($length)
    {
        $randomString = '';
        $unique = false;

        while (! $unique) {
            // Generates random string
            $randomString = $this->generator($length);

            // Sets the unique value to true
            $unique = true;

            // Pass to the unique checker
            if ($this->uniqueChecker) {
                $uniqueChecker = $this->uniqueChecker;
                $unique = $uniqueChecker($randomString);
            }
        }
        
        return $randomString;
    }

    /**
     * Sets the format of the string to be generated
     * 
     * u - upper-cased
     * l - lower-cased
     * r - random-cased
     * n - numeric-cased
     * s - special-characters
     * a - any characters
     *
     * @param String $format
     * @return String
     */
    public function setFormatAttribute($format)
    {
        $randomString = '';
        $unique = false;

        while (! $unique) {
            // Generates random string
            $randomString = $this->formattedGenerator($format);

            // Sets the unique value to true
            $unique = true;

            // Pass to the unique checker
            if ($this->uniqueChecker) {
                $uniqueChecker = $this->uniqueChecker;
                $unique = $uniqueChecker($randomString);
            }
        }
        
        return $randomString;
    }

    /**
     * Accepts a function and should return true if the value is unique  
     *
     * @param Function $callback
     * @return mixed
     */
    public function setUniqueAttribute($callback)
    {
        $this->uniqueChecker = $callback;

        return $this;
    }

    /**
     * Specifies the characters to be included in the random generator
     *
     * @param String $characters
     * @return mixed
     */
    public function setExcludeAttribute($characters)
    {
        $this->excluded = $characters;

        return $this;
    }

    /**
     * Specifies the characters to be included in the random generator
     *
     * @param String $characters
     * @return mixed
     */
    public function setIncludeAttribute($character)
    {
        $this->included = $character;

        return $this;
    }
}