<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCaffeine\Tests\Unit;

use GeneaLabs\LaravelCaffeine\Dripper;
use GeneaLabs\LaravelCaffeine\Tests\UnitTestCase;

class DripperTest extends UnitTestCase
{
    // * @test
    public function testHtmlValue(): void
    {
        $expectedResult = file_get_contents(__DIR__ . "/../Fixtures/unexpired_script.txt");

        $actualResult = (new Dripper)->getHtml();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
