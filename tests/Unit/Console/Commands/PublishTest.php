<?php namespace GeneaLabs\LaravelCaffeine\Tests\Unit\Console\Commands;

use GeneaLabs\LaravelCaffeine\Tests\TestCase;

class PublishTest extends TestCase
{
    public function testConfigFileGetsPublished()
    {
        app('artisan')::getFacadeRoot()->call('caffeine:publish', ['--config' => true]);

        $this->assertFileExists(base_path('config/genealabs-laravel-caffeine.php'));
    }

    public function testConfigFileContainsCorrectSettings()
    {
        $settings = file_get_contents(base_path('config/genealabs-laravel-caffeine.php'));

        $this->assertContains("'dripInterval' => 300000,", $settings);
        $this->assertContains("'domain' => null,", $settings);
        $this->assertContains("'route' => 'genealabs/laravel-caffeine/drip',", $settings);
        $this->assertContains("'outdatedDripCheckInterval' => 2000,", $settings);
    }
}
