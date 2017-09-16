<?php namespace GeneaLabs\LaravelCaffeine\Tests\Unit\Providers;

use Exception;
use GeneaLabs\LaravelCaffeine\Providers\Service;
use GeneaLabs\LaravelCaffeine\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
    public function testServiceProviderHint()
    {
        $expectedResult = ['genealabs-laravel-caffeine'];
        $actualResult = (new Service(app()))->provides();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
