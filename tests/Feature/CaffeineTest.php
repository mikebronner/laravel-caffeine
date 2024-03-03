<?php namespace GeneaLabs\LaravelCaffeine\Tests\Feature;

use GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware;
use GeneaLabs\LaravelCaffeine\Tests\FeatureTestCase;

class CaffeineTest extends FeatureTestCase
{
    public function testDripEndpoint()
    {
        $dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');

        $response = $this->get($dripRoute);

        $response->seeStatusCode(204);
    }

    public function testMiddlewareInjectsDripScript()
    {
        $expectedResult = file_get_contents(__DIR__ . '/../Fixtures/partial_script.txt');

        $response = $this->get(route('genealabs-laravel-caffeine.tests.form'));

        $response->see($expectedResult);
        $response->assertViewHas('foo');
    }

    public function testSuccessfulDrip()
    {
        $dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');
        $html = $this
            ->get(route('genealabs-laravel-caffeine.tests.form'))
            ->response
            ->getContent();
        $matches = [];
        preg_match('/<meta name="csrf-token" content="(.*?)">/', $html, $matches);
        $csrfToken = $matches[1];

        $response = $this->get($dripRoute, [
            '_token' => $csrfToken,
        ]);

        $response->seeStatusCode(204);
    }

    public function testExpiredDrip()
    {
        $dripRoute = config(
            'genealabs-laravel-caffeine.drip-interval',
            'genealabs/laravel-caffeine/drip'
        );
        $html = $this
            ->get(route('genealabs-laravel-caffeine.tests.form'))
            ->response
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

        $response->seeStatusCode(404);
    }

    public function testDisabledCaffeination()
    {
        $html = $this
            ->get(route('genealabs-laravel-caffeine.tests.disabled-page'))
            ->response
            ->getContent();

        $isDisabled = (bool) preg_match(
            '/<meta name="caffeinated" content="false">/',
            $html
        );
        $hasDripper = (bool) preg_match(
            '/\var caffeineSendDrip\b/',
            $html
        );

        $this->assertTrue($isDisabled);
        $this->assertFalse($hasDripper);
    }

    public function testNonStringReturnContent()
    {
        $response = $this->get(route('genealabs-laravel-caffeine.tests.null-response'));

        $response->dontSee('var caffeineSendDrip');
    }

    public function testRouteMiddleware()
    {
        app('router')->aliasMiddleware(
            'caffeinated',
            '\\' . LaravelCaffeineDripMiddleware::class
        );

        $response = $this
            ->get(route('genealabs-laravel-caffeine.tests.route-middleware'));

        $response->see('var caffeineSendDrip');
    }
}
