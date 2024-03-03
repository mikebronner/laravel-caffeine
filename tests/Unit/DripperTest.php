<?php namespace GeneaLabs\LaravelCaffeine\Tests\Unit;

use GeneaLabs\LaravelCaffeine\Dripper;
use GeneaLabs\LaravelCaffeine\Tests\UnitTestCase;

class DripperTest extends UnitTestCase
{
    public function testAgeCheckIntervalAttributeValue()
    {
        $expectedResult = 2000;

        $actualResult = (new Dripper)->ageCheckInterval;

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testAgeThresholdAttributeValue()
    {
        $expectedResult = 7080000;

        $actualResult = (new Dripper)->ageThreshold;

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testUrlAttributeValue()
    {
        $expectedResult = "http://127.0.0.1/genealabs/laravel-caffeine/drip";

        $actualResult = (new Dripper)->url;

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testIntervalAttributeValue()
    {
        $expectedResult = 300000;

        $actualResult = (new Dripper)->interval;

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testHtmlAttributeValue()
    {
        $expectedResult = file_get_contents(__DIR__ . '/../Fixtures/unexpired_script.txt');

        $actualResult = (new Dripper)->html;

        $this->assertEquals($expectedResult, $actualResult);
    }
}
