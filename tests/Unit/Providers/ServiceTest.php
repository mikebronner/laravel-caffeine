<?php namespace GeneaLabs\LaravelCaffeine\Tests\Unit\Providers;

use Exception;
use GeneaLabs\LaravelCaffeine\Providers\Service;
use GeneaLabs\LaravelCaffeine\Tests\UnitTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends UnitTestCase
{
    public function testServiceProviderHint()
    {
        $expectedResult = ['genealabs-laravel-caffeine'];
        $actualResult = (new Service(app()))->provides();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
