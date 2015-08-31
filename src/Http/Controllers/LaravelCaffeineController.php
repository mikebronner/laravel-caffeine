<?php namespace GeneaLabs\LaravelCaffeine\Http\Controllers;

use Illuminate\Routing\Controller;

class LaravelCaffeineController extends Controller
{
    /**
     * Keep the session from timing out.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function drip()
    {
        return response('', 204);
    }
}
