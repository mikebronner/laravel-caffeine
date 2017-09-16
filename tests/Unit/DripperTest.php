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

    public function testHtmlAttributeValue()
    {
        $expectedResult = "<script>setInterval(function(){var e=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');e.open('GET','/genealabs/laravel-caffeine/drip',!0);e.setRequestHeader('X-Requested-With','XMLHttpRequest');e.send();}, 300000);</script>";
        $actualResult = (new Dripper)->html;

        $this->assertEquals($expectedResult, $actualResult);
    }
}
