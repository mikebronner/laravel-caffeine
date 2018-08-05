<?php namespace GeneaLabs\LaravelCaffeine\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class Drip extends Controller
{
    public function drip()
    {
        return response(null, 204);
    }
}
