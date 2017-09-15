<?php namespace GeneaLabs\LaravelCaffeine\Console\Commands;

use GeneaLabs\LaravelCaffeine\Providers\Service;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel;

class Publish extends Command
{
    protected $signature = 'caffeine:publish {--config}';
    protected $description = 'Publish configuration file of the Caffeine for Laravel package.';

    public function handle()
    {
        if ($this->option('config')) {
            $this->call('vendor:publish', [
                '--provider' => Service::class,
                '--tag' => ['config'],
                '--force' => true,
            ]);
        }
    }
}
