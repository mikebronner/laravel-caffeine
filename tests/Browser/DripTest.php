<?php namespace GeneaLabs\LaravelCaffeine\Tests\Feature;

use GeneaLabs\LaravelCaffeine\Tests\BrowserTestCase;
use Laravel\Dusk\Browser;

class DripTest extends BrowserTestCase
{
    public function testFormDoesntExpire()
    {
        $this->browse(function (Browser $browser) {
            $response = $browser->visit('hello');
                // ->assertSee('hello world');
            dd($response->dump());
        });
    }
}
