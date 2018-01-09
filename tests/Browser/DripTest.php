<?php namespace GeneaLabs\LaravelCaffeine\Tests\Browser;

use GeneaLabs\LaravelCaffeine\Tests\BrowserTestCase;
use Laravel\Dusk\Browser;

class DripTest extends BrowserTestCase
{
    public function testFormDoesntExpire()
    {
        $this->browse(function (Browser $browser) {
            $response = $browser->visit('hello');
            // $response->dump();
            $response->assertSee('Test Form');
        });
    }
}
