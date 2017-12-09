<?php namespace GeneaLabs\LaravelCaffeine\Tests\Feature;

use GeneaLabs\LaravelCaffeine\Tests\TestCase;

class CaffeineTest extends TestCase
{
    public function testBootstrap3TestPageCanLoad()
    {
        $dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');
        $response = $this->get($dripRoute);

        $response->assertStatus(204);
    }

    public function testMiddlewareInjectsDripScript()
    {
        $expectedResult = file_get_contents(__DIR__ . '/../Fixtures/expired_script.txt');

        $response = $this->get(route('genealabs-laravel-caffeine.tests.form'));

        $response->assertSee($expectedResult);
    }
}
