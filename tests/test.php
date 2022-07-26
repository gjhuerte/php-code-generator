<?php

use Aux\Generator\Code;
use PHPUnit\Framework\TestCase;

final class Test extends TestCase
{
    public function testCanBeValidLength()
    {
        $stringLength = strlen(Code::generate(10));
        
        $this->assertTrue($stringLength == 10, "String length ($stringLength) is not equals to 10.");
    }
}