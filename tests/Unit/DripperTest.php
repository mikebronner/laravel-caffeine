<?php namespace GeneaLabs\LaravelCaffeine\Tests\Unit\Providers;

use Exception;
use GeneaLabs\LaravelCaffeine\Dripper;
use GeneaLabs\LaravelCaffeine\Tests\UnitTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $expectedResult = "/genealabs/laravel-caffeine/drip";

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

        $this->assertEquals($actualResult, $expectedResult);
    }
}
