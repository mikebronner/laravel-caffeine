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

    public function testSuccessfulDrip()
    {
        $dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');
        $html = $this->get(route('genealabs-laravel-caffeine.tests.form'))
            ->getContent();
        $matches = [];
        preg_match('/<meta name="csrf-token" content="(.*?)">/', $html, $matches);
        $csrfToken = $matches[1];

        $response = $this->get($dripRoute, [
            '_token' => $csrfToken,
        ]);

        $response->assertStatus(204);
    }

    public function testExpiredDrip()
    {
        $dripRoute = config(
            'genealabs-laravel-caffeine.dripInterval',
            'genealabs/laravel-caffeine/drip'
        );
        $html = $this->get(route('genealabs-laravel-caffeine.tests.form'))
            ->getContent();
        $matches = [];
        preg_match(
            '/<meta name="csrf-token" content="(.*?)">/',
            $html,
            $matches
        );
        $csrfToken = $matches[1];

        app('session')->flush();
        $response = $this->get($dripRoute, [
            '_token' => $csrfToken,
        ]);

        $response->assertStatus(404);
    }

    public function testDisabledCaffeination()
    {
        $html = $this
            ->get(route('genealabs-laravel-caffeine.tests.disabled-page'))
            ->getContent();

        $isDisabled = (bool) preg_match(
            '/<meta name="caffeinated" content="false">/',
            $html
        );
        $hasDripper = (bool) preg_match(
            '/\bconst caffeineSendDrip\b/',
            $html
        );

        $this->assertTrue($isDisabled);
        $this->assertFalse($hasDripper);
    }
}
