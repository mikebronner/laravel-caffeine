<?php namespace GeneaLabs\LaravelCaffeine\Tests\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class Test extends Controller
{
    public function drippedForm() : View
    {
        config()->set('session.lifetime', 1);
        config()->set('genealabs-laravel-caffeine.drip-interval', 50000);

        return view('genealabs-laravel-caffeine::tests.form')->with('foo');
    }

    public function disabledPage() : View
    {
        return view('genealabs-laravel-caffeine::tests.disabled');
    }

    public function nullResponse()
    {
        return null;
    }
}
