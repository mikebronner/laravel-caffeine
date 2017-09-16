<?php namespace GeneaLabs\LaravelCaffeine\Tests\Unit\Providers;

use Exception;
use GeneaLabs\LaravelCaffeine\Dripper;
use GeneaLabs\LaravelCaffeine\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DripperTest extends TestCase
{
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
}
