<?php namespace GeneaLabs\LaravelCaffeine\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class Test extends Controller
{
    public function drippedForm() : View
    {
        config()->set('session.lifetime', 1);
        config()->set('genealabs-laravel-caffeine.dripIntervalInMilliSeconds', 50000);

        return view('genealabs-laravel-caffeine::tests.form');
    }
}
