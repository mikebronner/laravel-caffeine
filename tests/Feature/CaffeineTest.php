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
}
