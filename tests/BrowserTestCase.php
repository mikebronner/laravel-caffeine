<?php namespace GeneaLabs\LaravelCaffeine\Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Orchestra\Testbench\Dusk\TestCase as BaseTestCase;

abstract class BrowserTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function driver() : RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--no-sandbox',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()
                ->setCapability(ChromeOptions::CAPABILITY, $options)
                ->setCapability('acceptInsecureCerts', TRUE)
        );
    }
}
