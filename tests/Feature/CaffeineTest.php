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
        // dd(\Route::getRoutes());
        $expectedResult = "<script>setInterval(function(){var e=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');e.open('GET','/genealabs/laravel-caffeine/drip',!0);e.setRequestHeader('X-Requested-With','XMLHttpRequest');e.send();}, 300000);</script>";

        $response = $this->get(route('genealabs-laravel-caffeine.tests.form'));

        $response->assertSee($expectedResult);
    }
}
