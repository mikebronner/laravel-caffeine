<?php namespace GeneaLabs\LaravelCaffeine\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class Drip extends Controller
{
    public function drip() : Response
    {
        return response('', 204);
    }
}
